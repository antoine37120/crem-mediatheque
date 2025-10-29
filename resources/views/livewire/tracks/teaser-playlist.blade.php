<div>
    <div class="card-track bg-transparent position-relative row m-0" >
        {{-- flex-row flex-lg-column --}}
        <div class="col-3 col-lg-3 col-xxl-2 justify-content-between flex-shrink-1 flex-nowrap mx-0 ps-0 ps-lg-0 pe-0 pb-4">
            <div class="position-relative p-0 col-11 col-lg-9 max-w-img-card-list" style="">
                <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..." style="background: {{ $track->getHexaColor() }};" width="150" height="150"/>
                <div class="position-absolute top-0 start-0 text-white ps-1">
                    {{ $track->year }}
                </div>
                <div class="position-absolute bottom-0 end-0 text-white pe-1">
                    {{ $track->durationFormated() }}
                </div>
                <div class="card-track-actions position-absolute top-0 end-0 p-1 d-none d-lg-block">
                    {{-- top-0 end-0 --}}
                    <livewire:tracks.actions :track="$track"  wire:key="teaser-playist-audio-actions-{{ $track->id }}"/>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-9 col-xxl-10 pb-2 pt-lg-2 ps-2 pe-0">
            <h5 class="card-title"><a  href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale())->name, 45, '...') }}</a></h5>
            <h5 class="fs-6">{{ $track->geographicalArea->translate(App::getLocale())->name }}</h5>
            <h5>Interprête / Collecteur : {{ $track->interpreters }} / {{ $track->collector }}</h5>
            <div>{!! $track->translate(App::getLocale(), true)->description !!}</div>
        </div>
        <div class="col-3 d-block d-lg-none text-right ps-0 pe-0">
            <livewire:tracks.actions :track="$track"  wire:key="teaser-playist-audio-actions-mobile-{{ $track->id }}"/>
        </div>
        {{-- <div class="card-track-actions mobile-tracks flex-shrink-1 d-block d-lg-none m-0 p-1">
        </div>--}}
    </div>

</div>
