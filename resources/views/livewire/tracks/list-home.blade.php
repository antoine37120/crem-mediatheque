<div>
    <h2 class="px-4 pb-4">Tracks</h2>
    <div class="row align-items-start g-5 pb-5">
    @foreach ($tracks as $track)
        <div class="col-sm-3 px-5">
            <livewire:tracks.teaser :track="$track" wire:key="audio-{{ $track->id }}" />
        </div>
    @endforeach
    </div>
</div>
