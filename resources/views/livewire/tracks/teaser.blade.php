<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

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
        <div class="py-2">
            
            <h5 class="card-title"><a  href="{{route('track', ['audioItem' => $track->id])}}" class="text-black text-decoration-none fw-bold" wire:navigate>{{ Illuminate\Support\Str::limit($track->translate(App::getLocale())->name, 45, '...') }}</a></h5>
            <p class="fs-5">{{ $track->geographicalArea->translate(App::getLocale())->name }}</p>
            
        </div>
        <div class="card-track-actions position-absolute top-0 end-0 p-3">
            <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
        </div>
    </div>

</div>
