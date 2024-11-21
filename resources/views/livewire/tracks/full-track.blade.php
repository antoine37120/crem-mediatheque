<div>
    {{-- mobile only --}}
    <div class="d-block d-md-none container mt-5">
        <div class="row w-100" style="width: 18rem;">
            <div class="col-12 text-center mb-4">
                <div class="" style="width: fit-content">
                    <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top border rounded" alt="..." style="background: {{ $track->randomColor() }};"/>
                </div>
            </div>
            <div class="col-10 mt-1 mb-4">
                <h5 class="fw-bold">{{ $track->geographicalArea->translate(App::getLocale(), true)->name }}</h5>
                <h5 class="fw-bold">{{ $track->interpreters }}</h5>
                <h5 class="fw-bold">{{ $track->collector }}</h5>
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
        <div class="row w-100" style="width: 18rem;">
            <div class="col-2 position-relative">
                    <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top border rounded" alt="..." style="background: {{ $track->randomColor() }};"/>
                    <div class="position-absolute top-0 start-0 p-2 text-white fs-5">
                        {{ $track->year }}
                    </div>
                    <div class="position-absolute bottom-0 end-0 p-2 text-white fs-5">
                        {{ $track->durationFormated() }}
                    </div>
                    <div class="card-track-actions position-absolute top-0 end-0 p-3">
                        <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
                    </div>
            </div>
            <div class="col-10">
                <h5 class="fw-bold">{{ $track->geographicalArea->translate(App::getLocale(), true)->name }}</h5>
                <h5 class="fw-bold">{{ $track->interpreters }}</h5>
                <h5 class="fw-bold">{{ $track->collector }}</h5>
                <div class="">{!! $track->translate(App::getLocale(), true)->description !!}</div>
                <p><a href="{{ $track->link }}" target="_blank"class="btn btn-primary">See on archive</a></p>
            </div>
            <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
        </div>
    </div>
</div>
