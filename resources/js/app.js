import './bootstrap';
import 'bootstrap';
import '@popperjs/core';
import sort from '@alpinejs/sort';
import Swal from 'sweetalert2';
window.Swal = Swal ;
console.log(window) ;

window.Alpine.plugin(sort)
import WaveSurfer from 'wavesurfer.js'
window.track_to_play = false;
window.Livewire.hook('morph.added',  ({ el }) => {
    if (el.hasAttribute('data-track-id') ) {
        window.loadLinksList() ;
        if(window.track_to_play) {
            window.initWithTrack(window.track_to_play, true) ;
            window.track_to_play = frameElement;
        }
    }
})
window.Livewire.hook('morph.removed', ({ el, component }) => {

    if (el.hasAttribute('data-track-id') ) {

        isFirstItem = false ;
        if (window.getCurrentTrackIndex() == null) {
            console.log(window.getCurrentTrackIndex()) ;
            console.log('Stop playing') ;
            window.wavesurfer.stop();
            window.wavesurfer.empty();
            window.wavesurfer.destroy();
            window.initPlayer() ;
            /*window.wavesurfer.load('')
            .catch((err) => {
              console.log('force init player');
            })*/
        }
    }
});

window.noticeUser = function (message='Track added to playlist', color="") {
    window.Swal.fire({
        //title: 'Yeah',
        toast: true,
        text: message,
        timer: 3000,
        showConfirmButton: false,   
        showDenyButton: false,
        position: 'top-end',
        timerProgressBar: true,
        animation: false,
        padding: '3px',
        background: 'rgba(255, 255, 255, 0.5)',
        customClass: {
            timerProgressBar: 'c_'+color,
          }
        })
}

window.Livewire.on('add_notice_user', (event) => {
    // Set window value to current track to play.
    window.noticeUser(event.text, event.color) ;
});


window.catchOrdering = function() {
    console.log('catchOrdering') ;
    links = document.querySelectorAll('tbody#playlist tr');
    let news_ids = [] ;
    let i = 1 ;
    Array.prototype.forEach.call(links, function(link, index) {

        let trackId = link.getAttribute('data-track-id');
        link.querySelector(".num").textContent = index + 1;
        news_ids.push(trackId) ;
    });
    window.Livewire.dispatch('reordering-playlist',  { ids: news_ids });
    window.loadLinksList() ;
}

window.Livewire.on('launch_play', (event) => {
    // Set window value to current track to play.
    window.track_to_play = event.trackToPlay ;
});

let isFirstItem = true ;
/*
 window.sleeping = async function (ms) {
    return await new Promise(resolve => setTimeout(resolve, ms));
}*/

// listening if changes in playlist on add or remove itiem
/*window.Livewire.on('playlist-items-list-refresh', () => {



});
// listening if curent track played is deleted
window.Livewire.on('playlist-plaiyed-item-deleted', () => {
    window.wavesurfer.stop();
});*/
// add event on links of playlist and curent track. Called after all playlist changes.
window.loadLinksList = function() {

    console.log('loadLinksList') ;
    links = document.querySelectorAll('tbody#playlist tr');
    console.log(links) ;
    Array.prototype.forEach.call(links, function(link, index) {
        link.removeEventListener('click', null);
        link.addEventListener('click', function(e) {
            console.log('Launched click on link') ;
            e.preventDefault();
            let trackId = link.getAttribute('data-track-id');
            console.log(trackId) ;
            window.setCurrentSong(trackId, true); //  launch play
        });
    });
    if(links.length == 0) {
        isFirstItem = true ;// init for next new item added
    }
    if(links.length == 1) {
        let trackId = links[0].getAttribute('data-track-id');
        if(isFirstItem) {
            isFirstItem = false ;
            window.setCurrentSong(trackId, true);
        } else {
            window.setCurrentSong(trackId, false);
        }

    }
    //window.refreshLinks();
}
// Inti playlist and player with track
window.initWithTrack = function(id, force_play = false) {
    isFirstItem = false ;
    console.log('initWithTrack') ;
    links = document.querySelectorAll('#playlist tr');
    Array.prototype.forEach.call(links, function(link, index) {
        let trackId = links[index].getAttribute('data-track-id');
        if (trackId == id) {
            window.setCurrentSong(trackId, force_play);
        }
    });
}
window.wavesurfer = null ;
let links = null ;
let currentTrack = 0;
console.log(window) ;
window.initPlayer = function() {
    console.log('initPlayer') ;
    let width = document.querySelector('body').offsetWidth ;
    let player_height = 20 ;
    console.log(width) ;
    if (width >= 992) {
        player_height = 70 ;
    }
    window.wavesurfer = WaveSurfer.create(
        {
            "container": "#player-progress-bar",
            "height": player_height,
            "width": "100%",
            "splitChannels": false,
            "normalize": false,
            "waveColor": "#000000",
            "progressColor": "#ff4e00",
            "cursorColor": "#ddd5e9",
            "cursorWidth": 2,
            "barWidth": 1,
            "barGap": null,
            "barRadius": null,
            "barHeight": null,
            "barAlign": "",
            "minPxPerSec": 1,
            "fillParent": true,
            //"url": "/wavesurfer-code/examples/audio/audio.wav",
            //"mediaControls": true,
            "autoplay": false,
            "interact": true,
            "dragToSeek": false,
            "hideScrollbar": false,
            "audioRate": 1,
            "autoScroll": true,
            "autoCenter": true,
            "sampleRate": 8000
          }
    );
    window.wavesurfer.on('load', function() {
        document.getElementById("player-progress-time-update").innerText = '';
    });

    /** When the audio is both decoded and can play */
    window.wavesurfer.on('ready', (duration) => {

    })


    let playPause = document.querySelector('#playPause');
    playPause.addEventListener('click', function() {
        console.log('click play/pause') ;
        window.wavesurfer.playPause();
    });

    // Toggle play/pause text
    window.wavesurfer.on('play', function() {
        document.querySelector('#play').style.display = 'none';
        document.querySelector('#pause').style.display = '';
    });

    window.wavesurfer.on('stop', function() {
        document.querySelector('#play').style.display = '';
        document.querySelector('#pause').style.display = 'none';

        document.getElementById("player-progress-time-update").innerText = '';
        document.getElementById("player-progress-duration").innerText = '';
    });
    window.wavesurfer.on('pause', function() {
        console.log('pause') ;
        document.querySelector('#play').style.display = '';
        document.querySelector('#pause').style.display = 'none';
    });
    window.wavesurfer.on('ready', function() {
        console.log('ready') ;
        //window.wavesurfer.play();
    });

    window.wavesurfer.on('error', function(e) {
        console.warn(e);
    });
    window.wavesurfer.on('audioprocess', function(e) {
        //console.warn(e);
        document.getElementById("player-progress-time-update").innerText = window.formatTime(e);
    });
    // Go to the next track on finish
    window.wavesurfer.on('finish', function() {
        currentTrack = window.getCurrentTrackIndex() ;
        links = document.querySelectorAll('#playlist tr');
        let current =window.getCurrentTrackIndex() ;
        if(current + 1 < links.length) {
            let next = current + 1 ;
            window.setCurrentSong(links[next].getAttribute('data-track-id'), true);
        } else {
            //load the firs track from playlist
            window.setCurrentSong(links[0].getAttribute('data-track-id'), false);
        }

    });
    window.wavesurfer.on('destroy', function() {
        document.querySelector('#play').style.display = '';
        document.querySelector('#pause').style.display = 'none';

        document.getElementById("player-progress-time-update").innerText = '';
        document.getElementById("player-progress-duration").innerText = '';
    });
    window.loadLinksList() ;
}
/*window.refreshLinks = function() {
    links = document.querySelectorAll('#playlist tr');
}*/

window.getCurrentTrackIndex = function() {
    const currentTrackNode = document.querySelector('#playlist tr.table-active');
    return currentTrackNode ? Array.from(currentTrackNode.parentNode.children).indexOf(currentTrackNode) : null;
}

window.getTrackIndex = function(trackId) {
    const currentTrackNode = document.querySelector('#playlist tr[data-track-id="' + trackId + '"]');
    return currentTrackNode ? Array.from(currentTrackNode.parentNode.children).indexOf(currentTrackNode) : null;
}


// Load a track by index and highlight the corresponding link
window.setCurrentSong = function(trackId, play = false) {
    trackId = Number(trackId) ;
    links = document.querySelectorAll('#playlist tr');
    currentTrack = window.getCurrentTrackIndex() ;
    console.log('currentTrack') ;
    console.log(currentTrack) ;
    console.log(links) ;
    if(currentTrack != null) {
        // just play if the same title loded an curently selected
        if (Number(links[currentTrack].getAttribute('data-track-id')) == trackId) {
            if ((play == true) && (window.wavesurfer.isPlaying())) {
                return ;
            }
            if ((play == true) && (!window.wavesurfer.isPlaying())) {
                window.wavesurfer.play();
                return ;
            }
        }
        links[currentTrack].classList.remove('table-active');
    }
    currentTrack = window.getTrackIndex(trackId) ;
    console.log(currentTrack) ;
    links[currentTrack].classList.add('table-active');
    let trackUrl = links[currentTrack].getAttribute('data-track-url');
    //let trackId = links[currentTrack].getAttribute('data-track-id');
    if (play) {
        console.log('play') ;

        window.wavesurfer.load(trackUrl).finally(() => {
            console.log('track loading completed launch play');
            window.wavesurfer.play();
          });

    } else {
        window.wavesurfer.load(trackUrl).finally(() => {
            console.log('track loading completed but not play');
            window.wavesurfer.stop();
            document.getElementById("player-progress-time-update").innerText = '00:00';
          });
    }
    let duration  = links[currentTrack].querySelector(".time").textContent;
    console.log(duration) ;
    if (duration !='') {
        document.getElementById("player-progress-duration").innerText = duration;
    }

    window.Livewire.dispatch('play-track-to-playlist',  { id: trackId });
};


        // Play on audio load


       /* window.addTrackToList = function(track) {
            let node = document.getElementById("playlist-clone-item").querySelector("a");

            console.log(node)
            let a = node.cloneNode(true);

            console.log('hahahahah') ;
            a.href = track.fileUrl;
            console.log(a) ;
            a.querySelector(".title").textContent = track.title;
            a.querySelector(".zone").textContent = track.zone;
            a.querySelector(".year").textContent = track.year;
            a.querySelector(".time").textContent = track.time;
            a.querySelector(".actions").textContent = track.actions;

            document.getElementById("playlist").appendChild(a);
            links = document.querySelectorAll('#playlist a');
            window.loadLinkList(links) ;
        }*/

window.formatTime = function(seconds) {
    return [
        //parseInt(seconds / 60 / 60),
        parseInt(seconds / 60 % 60),
        parseInt(seconds % 60)
    ]
        .join(":")
        .replace(/\b(\d)\b/g, "0$1")
}

        // Load the first track
        //window.setCurrentSong(currentTrack);
    //}

