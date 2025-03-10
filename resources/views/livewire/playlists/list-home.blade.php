<div>
    <h2 class="px-4 pb-4 fw-bold">
        <a href="{{route('playlists')}}" class="text-black text-decoration-none" wire:navigate>Playlists</a>
    </h2>
    <div class="row flex-nowrap align-items-start g-5 pb-5">
    @foreach ($playlists as $playlist)
        <div class="col-3 px-5 me-5 me-sm-3 me-lg-0">
            {{-- col-sm-6 col-lg-4 col-xxl-3 --}}
            <livewire:playlists.teaser :playlist="$playlist" key="home-playlist-teaser-{{$playlist}}" />
        </div>
    @endforeach
    </div>
</div>
