<div>
    <div class="row align-items-start my-2 g-5">
        <div class="col-2 ps-3">
            {{-- px-5 --}}
            <div class="card-track bg-transparent position-relative" >
                <div class="position-relative">
                    <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded border border-dark" alt="..." style="background: {{ $track->getHexaColor() }};"/>
                    <div class="position-absolute top-0 start-0 text-white ps-1">
                    {{-- p-1 p-md-2 fs-5 --}}
                    {{ $track->year }}
                    </div>
                    <div class="position-absolute bottom-0 end-0 text-white pe-1">
                    {{-- p-1 p-md-2 fs-5 --}}
                        {{ $track->durationFormated() }}
                    </div>
                    <div class="card-track-actions position-absolute top-0 end-0 p-1">
                        {{-- p-1 p-md-2 --}}
                        <livewire:tracks.actions :track="$track"  wire:key="teaser-playist-audio-actions-{{ $track->id }}"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-10 ps-6 ps-lg-0">
            <h5 class="card-title"><a  href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale())->name, 45, '...') }}</a></h5>
            <h5 class="fs-6">{{ $track->geographicalArea->translate(App::getLocale())->name }}</h5>
            <h5>Interprête / Collecteur : {{ $track->interpreters }} / {{ $track->collector }}</h5>
            <p>{!! $track->translate(App::getLocale(), true)->description !!}</p>
        </div>
    </div>
</div>
