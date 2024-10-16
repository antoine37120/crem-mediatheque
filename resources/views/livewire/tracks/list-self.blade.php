<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row align-items-start g-5">
    @foreach ($tracks as $track)
        <div class="col-sm-3 px-5">
            <livewire:tracks.teaser :track="$track" wire:key="audio-{{ $track->id }}" />
        </div>
    @endforeach
    </div>
</div>
