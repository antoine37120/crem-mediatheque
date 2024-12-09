<div>

    <div class="row">
    {{-- page d'une playlist avec ses morceaux --}}
        <div class="col-1">
            {{-- <div class="w-100">
            </div> --}}
        </div>
        <div class="col-10">
            <div class="row align-items-start">
                    <div class="col-sm-1 d-flex justify-content-center px-5">
                        <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top mr-5 mb-3 rounded border border-dark" style="min-width: 80px" alt="..."/>
                    </div>
                    <div class="col-sm-10">
                        {{-- ajouter fonction de traduction --}}
                        <p>{!! $playlist->translate(App::getLocale(), true)->description !!}</p>

                        <livewire:playlists.full-actions :playlist="$playlist" wire:key="playlist-full-actions-{{ $playlist->ID }}" />
                    </div>
            </div>

            {{-- teaser de chaque morceau de la playlist, avec description complète --}}
            @foreach ($playlist->audio_item_playlists as $relation_playlist)
                <livewire:tracks.teaser-playlist :track="$relation_playlist->audio_item" wire:key="audio-{{ $relation_playlist->audio_item->id }}" />
            @endforeach

        </div>
    </div>
</div>
