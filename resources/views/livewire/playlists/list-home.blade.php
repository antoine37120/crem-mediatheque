<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row align-items-start g-5 pb-5">
    @foreach ($playlists as $playlist)
        <div class="col-sm-3 px-5">
            <livewire:playlists.teaser :playlist="$playlist" />
        </div>
    @endforeach
    </div>
</div>
