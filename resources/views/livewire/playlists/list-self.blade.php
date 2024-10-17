<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="row align-items-start g-5">
    @foreach ($playlists as $playlist)
        <div class="col-sm-3 px-5">
            <livewire:playlists.teaser :playlist="$playlist" />
        </div>
    @endforeach
    </div>
</div>
