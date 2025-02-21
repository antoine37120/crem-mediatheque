<div>
    {{-- Stop trying to control. --}}

    <h2 class="px-4 pb-4 fw-bold">
        Playlists
    </h2>
    <div class="row align-items-start g-5 pb-5">
    @foreach ($playlists as $playlist)
        <div class="col-sm-6 col-lg-4 col-xxl-3  px-5">
            <livewire:playlists.teaser :playlist="$playlist" key="full-track-section-playlist-teaser-{{$playlist->id}}" />
        </div>
    @endforeach
    </div>
</div>
