<div>
    <div class="row">
        {{-- page d'un podcast avec ses morceaux --}}
        <div class="col-1">
            <div>
                "< / >"
            </div>
        </div>
        <div class="col-10">
            <div class="row align-items-start g-5">
                    <div class="col-sm-1 px-5">
                        <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top rounded border border-dark" style="height: 80px; width: 80px" alt="..."/>
                    </div>
                    <div class="col-sm-10">
                            {{-- ajouter fonction de traduction --}}
                            <h5 class="fw-bold">{{ $podcast->name }}</h5>
                            {{-- ajouter fonction de traduction --}}
                            <p>{{ $podcast->description }}</p>
                    </div>

            </div>
            {{-- teaser de chaque morceau de la playlist, avec description complète --}}
            <div class="container my-4">
                @foreach ($podcast->audio_item_playlists as $relation_playlist)
                    <livewire:tracks.teaser-podcast :track="$relation_playlist->audio_item" wire:key="audio-{{ $relation_playlist->audio_item->id }}" />
                @endforeach
            </div>
        </div>
    </div>
</div>

