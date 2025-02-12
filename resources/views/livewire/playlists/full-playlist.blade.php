<div>

    <div class="row">
    {{-- page d'une playlist avec ses morceaux --}}

        <div class="col-10 offset-1">
            <div class="row align-items-start">
                    <div class="col-sm-1 d-flex justify-content-center px-5">
                        <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top mr-5 mb-3 rounded border border-dark" style="min-width: 80px" alt="..."/>
                    </div>
                    <div class="col-sm-10">
                        {{-- ajouter fonction de traduction --}}
                        <p>{!! $playlist->translate(App::getLocale(), true)->description !!}</p>
                    </div>
            </div>
            <div class="row align-items-end">
                <livewire:playlists.full-actions :playlist="$playlist" wire:key="playlist-full-actions-{{ $playlist->id }}" />
            </div>

            {{-- teaser de chaque morceau de la playlist, avec description complète --}}
            @foreach ($playlist->audio_items() as $relation_playlist)
                <livewire:tracks.teaser-playlist :track="$relation_playlist->audio_item" wire:key="full-playlist-teaser-audio-{{ $relation_playlist->audio_item->id }}" />
            @endforeach

        </div>
    </div>
</div>
