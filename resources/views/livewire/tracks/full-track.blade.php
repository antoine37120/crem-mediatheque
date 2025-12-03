<div>
    {{-- mobile only --}}
    <div class="d-block mt-3">
        <div class="row m-0">
            {{-- style="width: 18rem;" --}}
            <div class="col-6 offset-3 col-lg-2 offset-lg-1 mb-4">
                <div class="position-relative  d-flex justify-content-sm-start" style="width: fit-content">
                    {{--  --}}
                    <img src="{{ url('storage/'.$track->picture) }}" class="w-100 h-100 border border-2 border-black rounded" alt="..." style="background: {{ $track->getHexaColor() }};"/>
                    <div class="position-absolute top-0 start-0 ps-1 pt-0 text-white">
                        {{ $track->year }}
                    </div>
                    <div class="position-absolute bottom-0 end-0 pe-1 text-white">
                        {{ $track->durationFormated() }}
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9 mt-0 mb-4">
                <div class="row m-0">
                    <div class="col-6">

                        @if($playlist_type != 'Podcast')
                            <h5>Zone : <span class="fw-bold"> {{ $track->geographicalArea->translate(App::getLocale(), true)->name }} </span></h5>
                            @if(!empty($track->interpreters))
                                <h5>Interprête(s) : <span class="fw-bold"> {{ $track->interpreters }} </span></h5>
                            @endif
                            @if(!empty($track->interpreters))
                                <h5>Collecteur : <span class="fw-bold"> {{ $track->collector }} </span></h5>
                            @endif
                        @endif
                        @if(!empty($track->year))
                            <h5 class="d-lg-none">Année : <span class="fw-bold"> {{ $track->year }} </span></h5>
                        @endif
                        <h5 class="d-lg-none">Durée : <span class="fw-bold"> {{ $track->durationFormated() }} </span></h5>
                        @if(!empty($track->link))
                            <div class="p-1 d-lg-none"><a href="{{ $track->link }}" target="_blank"class="btn btn-light rounded-5 p-1 px-2">See on archive</a></div>
                        @endif
                    </div>
                    <div class="col-6 justify-content-end">
                        <div class="d-flex justify-content-end">
                            @if(!empty($track->link))
                                <div class="p-1 d-lg-none"><a href="{{ $track->link }}" target="_blank"class="btn btn-light rounded-5 p-1 px-2">See on archive</a></div>
                            @endif
                            <livewire:tracks.full-actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 mt-1 mb-4">
                        {!! $track->translate(App::getLocale(), true)->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($playlist_type != 'Podcast')
        <div class="row m-0 mt-2">
            <div class="col-12 offset-lg-1 col-lg-11">
                <livewire:tracks.section-playlists :track="$track" key="full-track-section-playlist-{{$track->id}}" />
            </div>
        </div>
    @endif
</div>
    {{-- desktop only
    <div class="d-none container mt-5">
        <div class="w-100 d-flex flex-md-row">
            <div class="col-2 position-relative px-3" style="height: fit-content; width: fit-content">
                    <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded" alt="..." style="background: {{ $track->getHexaColor() }};" width="150" height="150"/>
                    <div class="position-absolute top-0 start-0 ps-4 pt-0 text-white">
                        {{ $track->year }}
                    </div>
                    <div class="position-absolute bottom-0 end-0 pe-4 text-white">
                        {{ $track->durationFormated() }}
                    </div>
                    <div class="card-track-actions position-absolute top-0 end-0 pt-2 pe-4">
                        <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
                    </div>
            </div>
            <div class="col-10 px-5">
                <h5>Zone : <span class="fw-bold"> {{ $track->geographicalArea->translate(App::getLocale(), true)->name }}</span></h5>
                <h5>Interprête(s) : <span class="fw-bold"> {{ $track->interpreters }} </span></h5>
                <h5>Collecteur : <span class="fw-bold"> {{ $track->collector }} </span></h5>
                <h5>Année : <span class="fw-bold"> {{ $track->year }} </span></h5>
                <div class="">{!! $track->translate(App::getLocale(), true)->description !!}</div>
                <p><a href="{{ $track->link }}" target="_blank"class="btn btn-primary">See on archive</a></p>
            </div>
        </div>
    </div> --}}

