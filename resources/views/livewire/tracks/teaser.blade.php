<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="card" style="width: 18rem;">
        <img src="{{ url('storage/'.$track->picture) }}" class="card-img-top" alt="..." style="background: #000;"/>
        <div class="card-body">
            <h5 class="card-title">{{ $track->translate(App::getLocale())->name }}</h5>
            <p class="card-text">{{ $track->translate(App::getLocale())->description }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <livewire:tracks.actions :track="$track"  wire:key="actions-{{ $track->id }}"/>
    </div>

</div>
