<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="row align-items-start">
    @foreach ($playlists as $playlist)
        <div class="col-3">
            <livewire:playlists.teaser :playlist="$playlist" />
        </div>
    @endforeach
    </div>
</div>
