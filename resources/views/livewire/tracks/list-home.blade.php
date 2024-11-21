<div>
    <h2 class="px-4 pb-4 fw-bold"><a href="{{route('tracks')}}" class="text-black text-decoration-none" wire:navigate>Tracks</a></h2>
    <div class="row align-items-start g-5 pb-5">
    @foreach ($tracks as $track)
         <div class="col-12 col-sm-6 col-lg-3 ps-5">
            <livewire:tracks.teaser :track="$track" wire:key="audio-{{ $track->id }}" />
        </div>
    @endforeach
    </div>
</div>
