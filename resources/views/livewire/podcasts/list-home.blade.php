<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row align-items-start">
    @foreach ($playlists as $playlist->where('type_id', 2))
    {{-- where playlist has type_id=2 --}}

        <div class="col-3">
            <livewire:playlists.teaser :playlist="$playlist" />
        </div>
    @endforeach
    </div>
</div>
