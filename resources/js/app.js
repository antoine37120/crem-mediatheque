import './bootstrap';
import 'bootstrap';
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
        console.log('Ready', duration + 's')
        const container = document.querySelector("#body-wave");
        var divs = container.querySelectorAll('div');
        var shadowroot = divs[0].shadowRoot
        var nodes = shadowroot.querySelectorAll('canvas');
        //var imgs = container.querySelectorAll('img');
        const canvas = nodes[0];
        const img    = canvas.toDataURL('image/png') ;
        //imgs[0].setAttribute('src', img) ;
        //container.innerText = img ;
        window.pngData = img;
    })




}
