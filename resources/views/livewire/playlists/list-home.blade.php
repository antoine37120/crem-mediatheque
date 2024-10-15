<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row align-items-start">
    @foreach ($playlists as $playlist)
        <div class="col-3">
            <livewire:playlists.teaser :playlist="$playlist" />
        </div>
    @endforeach
    </div>
</div>
