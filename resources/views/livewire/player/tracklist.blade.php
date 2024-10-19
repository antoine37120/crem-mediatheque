<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div x-data="{ expanded: false }">
        <div id="playlist-show" role="button" x-on:click="expanded = ! expanded" class="bg-secondary text-center text-white fs-5 text lh-1">
        · · ·
        </div>
        <table class="table table-sm mb-0" x-show="expanded">
            <thead>
                <tr>
                    <th scope="col" class="bg-light">#</th>
                    <th scope="col" class="bg-light">Titre</th>
                    <th scope="col" class="bg-light">Zone géographique</th>
                    <th scope="col" class="bg-light">Année</th>
                    <th scope="col" class="bg-light">Durée</th>
                    <th scope="col" class="bg-light"></th>
                </tr>
            </thead>
            <tbody id="playlist">
            @php 
                $i = 1 ;
            @endphp
            @foreach($playlist_items as $track)
                
                 <livewire:player.track-list-item :track="$track" :it="$i" :selected="$item_play" key="player-track-list-item-{{ $track->id }}" />
                {{--<tr data-track-url="{{ url('storage/'.$track->file) }}" data-track-id="{{ $track->id }}"  x-on:click="$wire.item_play='{{ $track->id }}'" class="{{ $item_play == $track->id ? "table-active" : "$item_play" }}">
                    <td class="num">{{ $i }}</td>
                    <td class="title">{{ $track->translate(App::getLocale())->name }}</td>
                    <td class="zone">{{ $track->geographicalArea->translate(App::getLocale())->name }}</td>
                    <td class="year">{{ $track->year }}</td>
                    <td class="time">{{ $track->durationFormated() }}</td>
                    <td class="actions">
                        <button class="btn p-1" wire:click.stop="$dispatch('delete-to-playlist', { id: {{ $track->id }} })">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash d-flex align-items-center justify-content-center" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>
                    </td>
                </tr> --}}

                @script
<script>
    console.log('start_play_id') ;
    console.log('{{ $start_play_id}}') ;
</script>
@endscript

                @php 
                    $i++ ;
                @endphp
            @endforeach 
            <tbody>
        </table>
    </div>
</div>


@script
<script>
    document.addEventListener('livewire:initialized', () => {
        // Runs immediately after Livewire has finished initializing
        // Initialize the player and playlist
        window.initPlayer();
        //window.loadLinksList() ;
        console.log('{{ $start_play_id}}') ;
        if ( '{{ $start_play_id}}' != 'none') {
            window.initWithTrack({{ $start_play_id}}) ;
        }
    })
</script>
@endscript