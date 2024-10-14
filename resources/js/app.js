import './bootstrap';
import 'bootstrap';
import '@popperjs/core';
import WaveSurfer from 'wavesurfer.js'

window.genrateWave = function(url, height, barGap, barWidth) {
    const wavesurfer = WaveSurfer.create({
    container: document.body,
    waveColor: 'rgb(255, 255, 255)',
    progressColor: 'rgb(100, 0, 100)',
    url: url,
    barGap: barGap,
    /** Render the waveform with bars like this: ▁ ▂ ▇ ▃ ▅ ▂ */
    barWidth: barWidth,
    height: height,
    });

    /** When the audio is both decoded and can play */
    wavesurfer.on('ready', (duration) => {

    })




}
