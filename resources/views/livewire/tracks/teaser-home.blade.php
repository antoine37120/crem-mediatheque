<div>
    <div class="card-track bg-transparent position-relative row m-0">
        {{-- flex-row flex-lg-column --}}
        <div class="col-12 justify-content-between flex-shrink-1 flex-nowrap mx-0 ps-0 ps-md-0 pe-0 pb-4 pb-md-0">
            <div class="position-relative p-0 col-11 col-md-9 max-w-img-card-list" style="">
                <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top rounded border border-dark border-2" alt="..." style="background: {{ $track->getHexaColor() }};"
                     width="150" height="150"
                     href="{{route('track', ['audioItem' => $track->id])}}" role="button"
                     wire:navigate
                />
                <div class="position-absolute top-0 start-0 text-white ps-1">
                    {{ $track->year }}
                </div>
                <div class="position-absolute bottom-0 end-0 text-white pe-1">
                    {{ $track->durationFormated() }}
                </div>
                <div class="card-track-actions position-absolute top-0 end-0 p-1 d-block">
                    {{-- top-0 end-0 --}}
                    <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
                </div>
            </div>
        </div>
        <div class="col-12 pb-2 pt-md-2 ps-2 pe-0">
            {{-- w-100 ms-2 ms-lg-0 --}}
            <h5 class="card-title"><a href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale(), true)?->name, 50, '...') }}</a></h5>
            <p class="fs-6 m-0">{{ $track->geographicalArea?->translate(App::getLocale(), true)?->name }}</p>
        </div>
    </div>
</div>
