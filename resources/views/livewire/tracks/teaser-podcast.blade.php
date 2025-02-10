<div>
    <div class="row align-items-start flex-nowrap my-2 g-5">
        <div class="card-track-col col-sm-2 ps-0">
            <div class="card-track bg-transparent position-relative" >
                <div class="position-relative">
                    <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..." style="height: 100px; width: 100px; background: {{ $track->getHexaColor() }};"/>
                </div>
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
                    <livewire:tracks.actions :track="$track"  wire:key="teaser-podcast-audio-actions-{{ $track->id }}"/>
                </div>
            </div>
        </div>
        <div class="col-10 ps-5 ps-md-4 ps-lg-3 ps-xl-0">

            <h5 class="card-title"><a  href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale())->name, 45, '...') }}</a></h5>
            <h5 class="fw-bold">{{ $track->geographicalArea->translate(App::getLocale())->name }}</h5>
            <h5 class="fw-bold">{{ $track->interpreters }}</h5>
            <h5 class="fw-bold">{{ $track->collector }}</h5>
            <div class="">{!! $track->translate(App::getLocale())->description !!}</div>
            <p><a href="{{ $track->link }}" target="_blank"class="btn btn-primary">See on archive</a></p>

        </div>
    </div>

</div>

