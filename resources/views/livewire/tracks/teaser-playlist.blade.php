<div>
    <div class="row align-items-start my-2 g-5">
        <div class="col-2 px-5">
            <div class="card-track bg-transparent position-relative" >
                <div class="position-relative">
                    <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded border border-dark" alt="..." style="background: {{ $track->randomColor() }};"/>
                    <div class="position-absolute top-0 start-0 p-2 text-white fs-5">
                        {{ $track->year }}
                    </div>
                    <div class="position-absolute bottom-0 end-0 p-2 text-white fs-5">
                        {{ $track->durationFormated() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-10">
            <h5 class="card-title"><a  href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale())->name, 45, '...') }}</a></h5>
            <h5 class="fs-5">{{ $track->geographicalArea->translate(App::getLocale())->name }}</h5>
            <h5>Interprête / Collecteur : {{ $track->interpreters }} / {{ $track->collector }}</h5>
            <p>{{ $track->description }}</p>
        </div>
    </div>
</div>
