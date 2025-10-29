<div>
    {{-- Stop trying to control. --}}

    <h2 class="px-0 pb-0 fw-bold mb-0">
        Playlists
    </h2>
    <div class="row align-items-start g-5 pb-5 m-0">
    @foreach ($playlists as $playlist)
        <div class="col-sm-6 col-lg-4 col-xxl-3  px-0">
            <livewire:playlists.teaser :playlist="$playlist" key="full-track-section-playlist-teaser-{{$playlist->id}}" />
        </div>
    @endforeach
    </div>
</div>
