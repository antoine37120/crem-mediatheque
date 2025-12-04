<div>

    <div class="row m-0">
    {{-- page d'une playlist avec ses morceaux --}}

        <div class="col-12 offset-lg-1 col-lg-11 p-2 px-lg-0 pt-lg-0 pb-lg-4">
            <div class="row align-items-start m-0">

                <div class="col-6 col-sm-6 offset-sm-3 offset-lg-0 col-lg-3 col-xxl-2 d-flex justify-content-sm-start px-0 d-lg-none">
                    <div class="position-relative col-10 col-lg-12 mx-0 mx-sm-auto">
                        <img src="{{ url('storage/'.$playlist->picture) }}" class="card-img-top rounded border border-dark border-2" style="" alt="..." width="150" height="150"/>
                    </div>
                </div>
                <div class="col-6 col-sm-3 col-lg-12 align-items-end px-lg-4 pb-lg-4">
                    <livewire:playlists.full-actions :playlist="$playlist" wire:key="playlist-full-actions-{{ $playlist->id }}" />
                </div>
                <div class="col-12 d-lg-none my-4">
                    {{-- ajouter fonction de traduction --}}
                    <div>{!! $playlist->translate(App::getLocale(), true)->description !!}</div>
                </div>
            </div>

            {{-- teaser de chaque morceau de la playlist, avec description complète --}}
            @foreach ($playlist->audio_items() as $relation_playlist)
                <livewire:tracks.teaser-playlist :track="$relation_playlist->audio_item" wire:key="full-playlist-teaser-audio-{{ $relation_playlist->audio_item->id }}" />
            @endforeach

        </div>
    </div>
</div>
