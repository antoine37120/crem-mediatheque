<div>
    {{-- mobile only --}}
    <div class="d-block d-md-none container mt-3">
        <div class="row w-100">
            {{-- style="width: 18rem;" --}}
            <div class="col-12 mb-4">
                <div class="position-relative m-auto" style="width: fit-content">
                    {{--  --}}
                    <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top border rounded" alt="..." style="background: {{ $track->getHexaColor() }};"/>
                    <div class="position-absolute top-0 start-0 ps-1 pt-0 text-white">
                        {{ $track->year }}
                    </div>
                    <div class="position-absolute bottom-0 end-0 pe-1 text-white">
                        {{ $track->durationFormated() }}
                    </div>
                </div>
            </div>
            <div class="col-10 mt-1 mb-4">
                <h5>Zone : <span class="fw-bold"> {{ $track->geographicalArea->translate(App::getLocale(), true)->name }} </span></h5>
                <h5>Interprête(s) : <span class="fw-bold"> {{ $track->interpreters }} </span></h5>
                <h5>Collecteur : <span class="fw-bold"> {{ $track->collector }} </span></h5>
                <h5>Année : <span class="fw-bold"> {{ $track->year }} </span></h5>
            </div>
            <div class="col-2">
                <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
            </div>
            <div>
                <div class="">{!! $track->translate(App::getLocale(), true)->description !!}</div>
                <p><a href="{{ $track->link }}" target="_blank"class="btn btn-primary">See on archive</a></p>
            </div>
        </div>
    </div>

    {{-- desktop only --}}
    <div class="d-none d-md-block container mt-5">
        <div class="w-100 d-flex flex-md-row">
            {{-- style="width: 18rem;" --}}
            {{-- row --}}
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
    </div>
</div>
