import './bootstrap';
import 'bootstrap';
import '@popperjs/core';
import WaveSurfer from 'wavesurfer.js'

// listening if changes in playlist on add or remove itiem
window.Livewire.on('playlist-items-list-refresh', () => {
    
    console.log('playlist-items-list-refresh') ;
    window.loadLinksList() ;
});
// listening if curent track played is deleted
window.Livewire.on('playlist-plaiyed-item-deleted', () => {
    window.wavesurfer.stop();
});
// add event on links of playlist and curent track. Called after all playlist changes.
window.loadLinksList = function() {
    
    console.log('loadLinksList') ;
    links = document.querySelectorAll('#playlist tr');
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
    //window.refreshLinks();  
}
// Inti playlist and player with track
window.initWithTrack = function(id) {
    console.log('initWithTrack') ;
    links = document.querySelectorAll('#playlist tr');
    Array.prototype.forEach.call(links, function(link, index) {
        let trackId = links[index].getAttribute('data-track-id');
        if (trackId == id) {
            window.setCurrentSong(trackId);
        }   
    });
}
window.wavesurfer = null ;
let links = null ;
let currentTrack = 0;
console.log(window) ;
window.initPlayer = function() {
    console.log('initPlayer') ;
    window.wavesurfer = WaveSurfer.create(
        {
            "container": "#player-progress-bar",
            "height": 128,
            "width": "100%",
            "splitChannels": false,
            "normalize": false,
            "waveColor": "#000000",
            "progressColor": "#ff4e00",
            "cursorColor": "#ddd5e9",
            "cursorWidth": 2,
            "barWidth": 12,
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
            console.log('track loading completed launch play');
            window.wavesurfer.stop();
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

