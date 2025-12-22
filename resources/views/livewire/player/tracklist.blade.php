<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div x-data="{ expanded: false }">
        <div id="playlist-show" role="button" x-on:click="expanded = ! expanded" class="bg-secondary text-center text-white fs-5 text lh-1" :class="{
        'expanded': expanded
    }">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="position-absolute top-0 start-50 translate-middle bi bi-chevron-compact-up bg-secondary" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M7.776 5.553a.5.5 0 0 1 .448 0l6 3a.5.5 0 1 1-.448.894L8 6.56 2.224 9.447a.5.5 0 1 1-.448-.894z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="position-absolute top-0 start-50 translate-middle bi bi-chevron-compact-down bg-secondary" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67"/>
            </svg>

        </div>
        <div class="playlist-grid-wrapper px-1" x-show="expanded">
            <!-- En-tête de la grille -->
            <div class="w-100">
                <div class="row bg-light py-2 border-bottom fw-bold m-0">
                    <div class="col-9 col-md-10">Titre</div>
                    <div class="col-1 col-md-1">Année</div>
                    <div class="col-2 col-md-1 text-end"></div>
                </div>
            </div>

            <!-- Liste des pistes -->
            <div id="playlist">
<div x-sort="window.catchOrdering()" x-sort:config="{  handle: '.sort-handler' }" class="container-fluid">
            @php
                    $i = 1 ;
                @endphp
                @foreach($playlist_items as $track)

                    <livewire:player.track-list-item :track="$track" :it="$i" :selected="$item_play" key="player-track-list-item-{{ $track->id }}" />

                    @php
                        $i++ ;
                    @endphp
                @endforeach
</div>
            </div>
        </div>
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
