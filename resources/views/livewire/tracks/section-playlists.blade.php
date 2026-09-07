<div>
    @if (count($playlists))
        <h2 class="px-0 pb-0 fw-bold mb-0">
            {{ __('pages.playlists.title') }}
        </h2>
        <div class="row align-items-start g-5 pb-5 m-0">
        @foreach ($playlists as $playlist)
            <div class="col-sm-6 col-lg-4 col-xxl-3  px-0">
                <livewire:playlists.teaser :playlist="$playlist" key="full-track-section-playlist-teaser-{{$playlist->id}}" />
            </div>
        @endforeach
        </div>
    @endif

    @if (count($podcasts))
        <h2 class="px-0 pb-0 fw-bold mb-0">
            {{ __('pages.podcasts.title') }}
        </h2>
        <div class="row align-items-start g-5 pb-5 m-0">
        @foreach ($podcasts as $podcast)
            <div class="col-sm-6 col-lg-4 col-xxl-3  px-0">
                <livewire:podcasts.teaser :podcast="$podcast" key="full-track-section-podcast-teaser-{{$podcast->id}}" />
            </div>
        @endforeach
        </div>
    @endif
</div>
