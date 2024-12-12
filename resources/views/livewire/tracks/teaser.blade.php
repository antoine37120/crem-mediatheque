<div>
    {{-- Mobile only --}}
    <div class="d-block d-lg-none card-track bg-transparent position-relative" >
        <div class="w-75">
            <div class="position-relative" style="width: fit-content">
                <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..." style="background: {{ $track->getHexaColor() }};"/>
                <div class="position-absolute top-0 start-0 text-white pe-1">
                {{ $track->year }}
                </div>
                <div class="position-absolute bottom-0 end-0 text-white pe-1">
                {{ $track->durationFormated() }}
                </div>
                <div class="card-track-actions position-absolute top-0 end-0 p-1">
                    <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
                </div>
            </div>
        </div>

        <div class="py-2 w-100">
            <h5 class="card-title"><a  href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale(), true)->name, 45, '...') }}</a></h5>
            <p class="fs-6">{{ $track->geographicalArea->translate(App::getLocale(), true)->name }}</p>

        </div>
    </div>


    {{-- Desktop only --}}
    <div class="d-none d-lg-block card-track bg-transparent position-relative" >
        <div class="w-75">
            <div class="position-relative" style="width: fit-content">
                <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..." style="background: {{ $track->getHexaColor() }};" width="150" height="150"/>
                <div class="position-absolute top-0 start-0 text-white ps-1">
                {{ $track->year }}
                </div>
                <div class="position-absolute bottom-0 end-0 text-white pe-1">
                {{ $track->durationFormated() }}
                </div>
                <div class="card-track-actions position-absolute top-0 end-0 p-1">
                    <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
                </div>
            </div>
        </div>
        <div class="py-2 w-100">

            <h5 class="card-title"><a  href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale(), true)->name, 50, '...') }}</a></h5>
            <p class="fs-6">{{ $track->geographicalArea->translate(App::getLocale(), true)->name }}</p>

        </div>
    </div>

</div>
