<div>
    <div class="row position-absolute bottom-100 w-100">
        <div class="col-10 offset-md-2">
            <livewire:player.tracklist />
        </div>
    </div>
    <div class="row">
        {{-- mobile --}}
        <div class="player-mobile d-xs-block d-sm-none">
            <div class="row">
                <div class="col-2"><img src="storage\app\public\audio-item\audioitem1-wave.png" alt=""> </div>
                <div class="col-3">Titre du morceau</div>
                <div class="col-5"></div>
                <div class="col-2">play/pause</div>
            </div>
            <div class="row">progress bar</div>
            <div class="row">timelapse</div>
        </div>
        {{-- desktop --}}
        
        <div class="row player-descktop d-xs-none d-sm-flex">
            <div class="col-1"><img src="storage\app\public\audio-item\audioitem1-wave.png" alt=""> </div>
            <div class="col-2">Titre du morceau</div>
            <div class="col-md-6 offset-md-1">
                <div class="row">
                    {{-- player commands --}}
                    <div class="col">random</div>
                    <div class="col">backward</div>
                    <div class="col">
                        <button class="btn btn-success btn-block" id="playPause">
                            <span id="play" style="">
                                <i class="glyphicon glyphicon-play"></i>
                                Play
                            </span>

                            <span id="pause" style="display: none;">
                                <i class="glyphicon glyphicon-pause"></i>
                                Pause
                            </span>
                        </button>
                    </div>
                    <div class="col">forward</div>
                    <div class="col">repeat</div>
                </div>
                <div class="row">
                    {{-- progress-bar --}}
                    
                    <livewire:player.progress-bar />
                </div>
            </div>
        </div>
    </div>
</div>
