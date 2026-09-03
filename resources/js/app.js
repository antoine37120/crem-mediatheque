// ---------------------------------------------------------------------------
// CREM audio player — single source of truth on the JS side.
//
// The playlist state itself lives in Livewire (Tracklist component). This
// module keeps a *snapshot* of it (player.queue) captured whenever the DOM
// changes (morph hooks), and every playback decision is made from that
// snapshot — audio event handlers never re-read the live DOM. That removes
// the races (stale row lists) that caused skipped tracks.
//
// Public API kept for the Blade views / Alpine / Livewire:
//   window.initPlayer()                       (tracklist.blade.php @script)
//   window.initWithTrack(id, forcePlay)       (tracklist.blade.php @script)
//   window.catchOrdering()                    (x-sort callback)
//   window.loadLinksList(), window.formatTime(t),
//   window.getCurrentTrackIndex(), window.getTrackIndex(id)
//   window.wavesurfer                         (WaveSurfer v7 instance)
// ---------------------------------------------------------------------------

import { Tooltip, Toast, Popover } from 'bootstrap/dist/js/bootstrap.bundle.min.js';
import '@popperjs/core';
import sort from '@alpinejs/sort';
import Swal from 'sweetalert2';
import WaveSurfer from 'wavesurfer.js';

window.Swal = Swal;
window.Alpine.plugin(sort);

const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
tooltipTriggerList.map((el) => new Tooltip(el));

// --- Player state -----------------------------------------------------------

const player = {
    queue: [],            // [{ id, url, time }] snapshot of the current rows
    currentId: null,      // id of the track loaded in the player
    isLoading: false,     // a load() is in flight
    loadToken: 0,         // incremented per load; stale loads are ignored
    autoPlayFirst: true,  // auto-play the very first track added to an empty queue
    pendingPlay: null,    // { id, autoplay } deferred until rows are available
    lastFinishAt: 0,      // debounce guard against double 'ended' events
};

let lastDispatchedPlayId = null;

const timeText = () => document.getElementById('player-progress-time-update');
const durationText = () => document.getElementById('player-progress-duration');

// --- State snapshot ---------------------------------------------------------

function rebuildQueue() {
    player.queue = Array.from(document.querySelectorAll('#playlist .row')).map((row) => ({
        id: Number(row.getAttribute('data-track-id')),
        url: row.getAttribute('data-track-url'),
        time: row.querySelector('.time')?.textContent ?? '',
    }));
    if (player.queue.length === 0) {
        player.autoPlayFirst = true; // next added track will auto-play
    }
}

function findEntry(id) {
    return player.queue.find((t) => t.id === Number(id)) ?? null;
}

// --- Display helpers ---------------------------------------------------------

function highlight(id) {
    const row = document.querySelector(`#playlist .row[data-track-id="${Number(id)}"]`);
    document.querySelectorAll('#playlist .row.bg-light').forEach((r) => {
        r.classList.remove('bg-light');
        r.classList.remove('load-to-player');
    });
    if (row) {
        row.classList.add('bg-light');
        row.classList.add('load-to-player');
    }
}

function showIcons(playing) {
    document.querySelector('#play').style.display = playing ? 'none' : '';
    document.querySelector('#pause').style.display = playing ? '' : 'none';
}

function dispatchPlay(id) {
    if (lastDispatchedPlayId === id) return; // no server round-trip for no-op updates
    lastDispatchedPlayId = id;
    window.Livewire.dispatch('play-track-to-playlist', { id });
}

// --- Core -------------------------------------------------------------------

function loadEntry(entry, autoplay) {
    const token = ++player.loadToken;
    player.isLoading = true;
    const done = () => {
        if (token !== player.loadToken) return; // superseded by a newer load
        player.isLoading = false;
        if (autoplay) {
            window.wavesurfer.play();
            showIcons(true);
        } else {
            window.wavesurfer.stop();
            if (timeText()) timeText().innerText = '00:00';
        }
    };
    const request = window.wavesurfer.load(entry.url);
    if (request && typeof request.finally === 'function') {
        request.finally(done);
    } else {
        done();
    }
    if (entry.time !== '' && durationText()) {
        durationText().innerText = entry.time;
    }
}

// The single entry point to play a track. autoplay=false loads and preselects
// without playing (used at page init for the last played track).
window.playTrack = function (id, autoplay = false) {
    id = Number(id);
    const entry = findEntry(id);
    if (!entry) {
        // Null-safe by design (the old code crashed on links[null] here).
        console.warn('[player] track not in queue snapshot:', id);
        return;
    }
    if (player.currentId === id) {
        // Same track: restart only on explicit request, and never interrupt a
        // load already in flight for it (removes the start-of-playlist restart).
        if (autoplay && !player.isLoading) {
            window.wavesurfer.stop();
            window.wavesurfer.play();
            showIcons(true);
        }
        highlight(id);
        dispatchPlay(id);
        return;
    }
    player.currentId = id;
    highlight(id);
    loadEntry(entry, autoplay);
    dispatchPlay(id);
};

function flushPendingPlay() {
    const pending = player.pendingPlay;
    if (!pending || !window.wavesurfer) return;
    if (!findEntry(pending.id)) return; // rows not rendered yet
    player.pendingPlay = null;
    window.playTrack(pending.id, pending.autoplay);
}

// --- WaveSurfer wiring (done once) -------------------------------------------

window.initPlayer = function () {
    if (window.wavesurfer) return; // idempotent (the old code leaked instances)

    const width = document.querySelector('body').offsetWidth;
    window.wavesurfer = WaveSurfer.create({
        container: '#player-progress-bar',
        height: width >= 992 ? 70 : 20,
        width: '100%',
        splitChannels: false,
        normalize: false,
        waveColor: '#000000',
        progressColor: '#ff4e00',
        cursorColor: '#ddd5e9',
        cursorWidth: 2,
        barWidth: 1,
        barGap: null,
        barRadius: null,
        barHeight: null,
        barAlign: '',
        minPxPerSec: 1,
        fillParent: true,
        autoplay: false,
        interact: true,
        dragToSeek: false,
        hideScrollbar: false,
        audioRate: 1,
        autoScroll: true,
        autoCenter: true,
        sampleRate: 8000,
    });

    const ws = window.wavesurfer;

    ws.on('play', () => showIcons(true));
    ws.on('pause', () => showIcons(false));
    ws.on('stop', () => {
        showIcons(false);
        if (timeText()) timeText().innerText = '';
    });
    ws.on('destroy', () => {
        showIcons(false);
        if (timeText()) timeText().innerText = '';
        if (durationText()) durationText().innerText = '';
    });
    ws.on('audioprocess', (seconds) => {
        if (timeText()) timeText().innerText = window.formatTime(seconds);
    });
    ws.on('error', (e) => console.warn(e));

    // Auto-advance. Guarded twice: never advance while a load is in flight
    // (stale 'ended' from a superseded source) and never twice in a row
    // (browsers can re-emit 'ended' while the source is being swapped).
    ws.on('finish', () => {
        if (player.isLoading) return;
        const now = performance.now();
        if (now - player.lastFinishAt < 1000) return;
        player.lastFinishAt = now;
        if (player.queue.length === 0 || player.currentId == null) return;
        const idx = player.queue.findIndex((t) => t.id === player.currentId);
        if (idx === -1) return;
        if (idx + 1 < player.queue.length) {
            window.playTrack(player.queue[idx + 1].id, true);
        } else {
            const repeat = document.querySelector('#player-repeat')?.classList.contains('enabled');
            window.playTrack(player.queue[0].id, Boolean(repeat));
        }
    });

    // One delegated listener for the whole queue — survives morphs, never stacks
    // (the old code re-attached a new handler on every row on every change).
    document.addEventListener('click', (e) => {
        const row = e.target.closest('#playlist .row');
        if (!row) return;
        if (e.target.closest('button')) return; // trash button has its own handler
        e.preventDefault();
        window.playTrack(row.getAttribute('data-track-id'), true);
    });

    // Transport
    document.querySelector('#playPause').addEventListener('click', () => ws.playPause());

    // Shuffle: keep the current track first, shuffle the rest, then hand the
    // new order to Livewire. NEVER reorder the row nodes here: they are the
    // root elements of Livewire child components — moving them in the DOM
    // breaks Livewire's component snapshots ("Snapshot missing"). The queue
    // snapshot is resynced by the MutationObserver once the morph has applied
    // the new order.
    document.querySelector('#player-btnrandom').addEventListener('click', () => {
        const current = player.queue.find((t) => t.id === player.currentId) ?? null;
        const rest = player.queue.filter((t) => t.id !== player.currentId);
        for (let i = rest.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [rest[i], rest[j]] = [rest[j], rest[i]];
        }
        const ids = current ? [current.id, ...rest.map((t) => t.id)] : rest.map((t) => t.id);
        window.Livewire.dispatch('reordering-playlist', { ids });
    });

    // Repeat mode is a pure CSS toggle, read at finish time.
    document.querySelector('#player-repeat').addEventListener('click', () => {
        document.querySelector('#player-repeat').classList.toggle('enabled');
    });

    const step = (delta) => {
        if (player.queue.length === 0 || player.currentId == null) return;
        const idx = player.queue.findIndex((t) => t.id === player.currentId);
        if (idx === -1) return;
        const next = (idx + delta + player.queue.length) % player.queue.length;
        window.playTrack(player.queue[next].id, true);
    };
    document.querySelector('#player-forward').addEventListener('click', () => step(1));
    document.querySelector('#player-rewind').addEventListener('click', () => step(-1));

    rebuildQueue();
    if (player.queue.length > 0) {
        player.autoPlayFirst = false; // queue restored at first paint: no auto-play
    }

    // Keep the queue snapshot in sync with every DOM change. A Livewire reorder
    // morph MOVES rows (insertBefore), which does not fire morph.added — without
    // this observer the snapshot would keep the pre-shuffle order and finish /
    // next would advance along the old sequence. Debounced so a whole morph
    // pass collapses into one rebuild (the callback runs after the morph task).
    let rebuildQueued = false;
    new MutationObserver(() => {
        if (rebuildQueued) return;
        rebuildQueued = true;
        setTimeout(() => {
            rebuildQueued = false;
            rebuildQueue();
        }, 0);
    }).observe(document.querySelector('#playlist'), { childList: true, subtree: true });
};

// --- Compatibility API -------------------------------------------------------

// Load a track by id without playing (page init preload), or play it when
// forcePlay is true. Same semantics as before, one implementation underneath.
window.initWithTrack = function (id, forcePlay = false) {
    window.playTrack(id, forcePlay);
};

window.loadLinksList = function () {
    rebuildQueue();
};

window.catchOrdering = function () {
    const ids = Array.from(document.querySelectorAll('div#playlist .row')).map((row) =>
        row.getAttribute('data-track-id'),
    );
    window.Livewire.dispatch('reordering-playlist', { ids });
    rebuildQueue();
};

window.getCurrentTrackIndex = function () {
    const idx = player.queue.findIndex((t) => t.id === player.currentId);
    return idx === -1 ? null : idx;
};

window.getTrackIndex = function (trackId) {
    const idx = player.queue.findIndex((t) => t.id === Number(trackId));
    return idx === -1 ? null : idx;
};

window.formatTime = function (seconds) {
    return [parseInt((seconds / 60) % 60), parseInt(seconds % 60)]
        .join(':')
        .replace(/\b(\d)\b/g, '0$1');
};

// --- Livewire bridge ----------------------------------------------------------

window.Livewire.on('add_notice_user', (event) => {
    window.Swal.fire({
        toast: true,
        text: event.text,
        timer: 3000,
        showConfirmButton: false,
        showDenyButton: false,
        position: 'top-end',
        timerProgressBar: true,
        animation: false,
        padding: '3px',
        background: 'rgba(255, 255, 255, 0.5)',
        customClass: { timerProgressBar: 'c_' + event.color },
    });
});

// Play a given track after a queue replacement (play playlist / play track).
// Note: Livewire applies dispatched events BEFORE the DOM morph, so the target
// row may not be in the snapshot yet — defer to the next morph in that case.
window.Livewire.on('launch_play', (event) => {
    if (!window.wavesurfer || !findEntry(event.trackToPlay)) {
        player.pendingPlay = { id: event.trackToPlay, autoplay: true };
        return;
    }
    window.playTrack(event.trackToPlay, true);
});

// Track rows added/removed by Livewire morphs.
window.Livewire.hook('morph.added', ({ el }) => {
    if (!el.hasAttribute('data-track-id')) return;
    rebuildQueue();
    if (player.autoPlayFirst) {
        player.autoPlayFirst = false;
        player.pendingPlay = { id: el.getAttribute('data-track-id'), autoplay: true };
    }
    flushPendingPlay();
});

window.Livewire.hook('morph.removed', ({ el }) => {
    if (!el.hasAttribute('data-track-id')) return;
    const removedId = Number(el.getAttribute('data-track-id'));
    if (removedId !== player.currentId) return;
    // Decide after the morph pass completes, once the DOM is final.
    queueMicrotask(() => {
        const stillThere = document.querySelector(`#playlist .row[data-track-id="${removedId}"]`);
        if (stillThere) return;
        player.currentId = null;
        player.isLoading = false;
        player.loadToken++; // invalidate any in-flight load
        lastDispatchedPlayId = null;
        window.wavesurfer.stop();
        window.wavesurfer.empty();
    });
});
