<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row align-items-start">
    @foreach ($tracks as $track)
        <div class="col">
            <livewire:tracks.teaser :track="$track" wire:key="audio-{{ $track->id }}" />
        </div>
    @endforeach
    </div>
</div>
