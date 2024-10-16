{{-- <div>
    <div class="card" style="width: 18rem;">
        <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top" alt="..." style="background: #000;"/>
        <div class="card-body">
            <h5 class="card-title">{{ $playlist->translate(App::getLocale())->name }}</h5>
            <p class="card-text">{{ $playlist->translate(App::getLocale())->description }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>

</div> --}}

<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="card-track bg-transparent position-relative" >
        <div class="position-relative w-75">
            <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top rounded border border-dark" alt="..." style="background: {{ $playlist->randomColor() }};"/>

            {{-- <div class="position-absolute top-0 start-0 p-2 text-white fs-5">
            {{ $track->year }}
            </div>
            <div class="position-absolute bottom-0 end-0 p-2 text-white fs-5">
            {{ $track->durationFormated() }}
            </div> --}}
            {{-- <div class="card-track-actions position-absolute top-0 end-0 p-3">
                <livewire:tracks.actions :playlist="$playlist"  wire:key="actions-{{ $playlist->id }}"/>
            </div> --}}
        </div>
        <div class="py-2">

            <h5 class="playlist-title"><a  href="{{route('playlist', ['playlist' => $playlist->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($playlist->translate(App::getLocale())->name, 45, '...') }}</a></h5>
            {{-- <p class="fs-5">{{ $track->geographicalArea->translate(App::getLocale())->name }}</p> --}}

        </div>
    </div>

</div>
