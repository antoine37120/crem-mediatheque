import './bootstrap';
import 'bootstrap';
import '@popperjs/core';
import WaveSurfer from 'wavesurfer.js'


// Load the track on click
window.loadLinkList = function(links) {
    Array.prototype.forEach.call(links, function(link, index) {
        link.removeEventListener('click', null);
        link.addEventListener('click', function(e) {
            e.preventDefault();
            window.setCurrentSong(index);
        });
    });
    window.refreshLinks();  
}
// Load the track on click
window.playLinkToList = function(id) {
    Array.prototype.forEach.call(links, function(link, index) {
        let trackId = links[index].getAttribute('data-track-id');
        if (trackId == id) {
            window.setCurrentSong(index);
        }   
    });
}
window.wavesurfer = null ;
let links = null ;
let currentTrack = 0;
console.log(window) ;
window.initPlayer = function() {
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
   //window.onload = function() {
    let playPause = document.querySelector('#playPause');
    playPause.addEventListener('click', function() {
        window.wavesurfer.playPause();
    });

    // Toggle play/pause text
    window.wavesurfer.on('play', function() {
        document.querySelector('#play').style.display = 'none';
        document.querySelector('#pause').style.display = '';
    });
    window.wavesurfer.on('pause', function() {
        document.querySelector('#play').style.display = '';
        document.querySelector('#pause').style.display = 'none';
    });
    window.wavesurfer.on('ready', function() {
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
        window.setCurrentSong((currentTrack + 1) % links.length);
    });
    // The playlist links
    currentTrack = 0;
    links = document.querySelectorAll('#playlist tr');
    window.loadLinkList(links) ;
}
window.refreshLinks = function() {
    links = document.querySelectorAll('#playlist tr');
}


// Load a track by index and highlight the corresponding link
window.setCurrentSong = function(index) {
    console.log(links);
    console.log(index); 
    links[currentTrack].classList.remove('table-active');
    currentTrack = index;
    links[currentTrack].classList.add('table-active');
    let trackUrl = links[currentTrack].getAttribute('data-track-url');
    let trackId = links[currentTrack].getAttribute('data-track-id');
    window.wavesurfer.load(trackUrl);
    let duration  = links[currentTrack].querySelector(".time").textContent; 
    document.getElementById("player-progress-duration").innerText = window.formatTime(duration);
    //window.Livewire.dispatch('play-track-to-playlist',  { id: trackId });
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

