<div>
    <div class="row">
        {{-- page d'un podcast avec ses morceaux --}}
        <div class="col-1">
            <div>
            </div>
        </div>
        <div class="col-10">
            <div class="row align-items-start g-5">
                    <div class="col-md-1 d-flex justify-content-center px-5">
                        <img src="{{ url('storage/'.$podcast->picture) }}" class="card-img-top mr-5 mb-3 rounded border border-dark" style="min-width: 80px" alt="..."/>
                    </div>
                    <div class="col-sm-10">
                            {{-- ajouter fonction de traduction --}}
                            <p>{!! $podcast->translate(App::getLocale(), true)->description !!}</p>

                            
                            
                    </div>

            </div>
            <div class="row align-items-end">
                <livewire:playlists.full-actions :playlist="$podcast" wire:key="playlist-full-actions-{{ $podcast->id }}" />
            </div>
            {{-- teaser de chaque morceau de la playlist, avec description complète --}}
            <div class="container my-4">
                @foreach ($podcast->audio_items() as $relation_playlist)
                    <livewire:tracks.teaser-podcast :track="$relation_playlist->audio_item" wire:key="audio-{{ $relation_playlist->audio_item->id }}" />
                @endforeach
            </div>
        </div>
    </div>
</div>

