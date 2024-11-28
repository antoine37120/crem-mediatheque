<div>
    <div class="row position-absolute bottom-100 w-100 m-0">
        <div class="col-10 offset-md-2 px-0">
            <livewire:player.tracklist />
        </div>
    </div>
    <div class="row m-0">
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
        <div class="row position-relative player-descktop d-xs-none d-sm-flex bg-white p-0 m-0">
            <div class="col-4 position-absolute top-0 start-0">
                <livewire:player.track-title :id="$item_play" />
            </div>
            <div class="col-md-10 offset-md-2 p-0 me-0">
            {{-- <div class="col-md-10 offset-md-2 p-0 me-0"> --}}
                    <div class="row justify-content-center m-0">


                    <div class="col-6">
                        <div class="row align-items-center justify-content-center">
                            {{-- player commands --}}
                            <div class="col-auto">
                                <button class="btn rounded-circle" id="player-btnrandom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-shuffle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.6 9.6 0 0 0 7.556 8a9.6 9.6 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.6 10.6 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.6 9.6 0 0 0 6.444 8a9.6 9.6 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5"/>
                                        <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn rounded-circle" id="player-rewind">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-rewind-fill" viewBox="0 0 16 16">
                                        <path d="M8.404 7.304a.802.802 0 0 0 0 1.392l6.363 3.692c.52.302 1.233-.043 1.233-.696V4.308c0-.653-.713-.998-1.233-.696z"/>
                                        <path d="M.404 7.304a.802.802 0 0 0 0 1.392l6.363 3.692c.52.302 1.233-.043 1.233-.696V4.308c0-.653-.713-.998-1.233-.696z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-lg btn-block rounded-circle py-1" id="playPause">
                                    <span id="play" style="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                            <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                        </svg>
                                    </span>

                                    <span id="pause" style="display: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-pause-fill" viewBox="0 0 16 16">
                                            <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5m5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5"/>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn rounded-circle" id="player-rewind">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-fast-forward-fill" viewBox="0 0 16 16">
                                        <path d="M7.596 7.304a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                        <path d="M15.596 7.304a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn rounded-circle" id="player-repeat">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
                                        <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            {{-- progress-bar --}}
                            <livewire:player.progress-bar />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
