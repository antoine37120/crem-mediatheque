<div>
    <div class="card-track d-flex flex-row flex-lg-column bg-transparent position-relative" >
        <div class="justify-content-between flex-shrink-1 flex-nowrap mx-0">
            {{-- w-75 --}}
            {{-- row --}}
            <div class="position-relative p-0" style="width: fit-content">
                {{-- col-8  --}}
                <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..." style="background: {{ $track->getHexaColor() }};" width="150" height="150"/>
                <div class="position-absolute top-0 start-0 text-white ps-1">
                    {{ $track->year }}
                </div>
                <div class="position-absolute bottom-0 end-0 text-white pe-1">
                    {{ $track->durationFormated() }}
                </div>
                <div class="card-track-actions d-none d-lg-block position-absolute top-0 end-0 p-1">
                    <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
                </div>
            </div>
        </div>
        <div class="py-2 ms-2 ms-lg-0 w-100 mobile-tracks home-teaser-text">
            <h5 class="card-title"><a href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale(), true)->name, 50, '...') }}</a></h5>
            <p class="fs-6">{{ $track->geographicalArea->translate(App::getLocale(), true)->name }}</p>
        </div>
        <div class="card-track-actions mobile-tracks flex-shrink-1 d-block d-lg-none me-0 p-1">
            <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
        </div>
    </div>

</div>
