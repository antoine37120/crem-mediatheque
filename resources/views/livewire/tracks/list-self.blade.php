<div>
    <div class="row align-items-start g-5">
        @foreach ($tracks as $track)
        <div class="col-12 col-sm-6 col-lg-3 px-5">
            <livewire:tracks.teaser :track="$track" wire:key="audio-{{ $track->id }}" />
        </div>
        @endforeach
    </div>
</div>
