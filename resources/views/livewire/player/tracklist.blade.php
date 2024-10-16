<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div x-data="{ expanded: false }">
        <div id="playlist-show" role="button" x-on:click="expanded = ! expanded" class="bg-secondary text-center text-white fs-5 text lh-1">
        · · ·
        </div>
        <table class="table table-sm mb-0" x-show="expanded">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Zone géographique</th>
                    <th scope="col">Année</th>
                    <th scope="col">Durée</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="playlist">
            @php 
                $i = 1 ;
            @endphp
            @foreach($playlist_items as $track)
                <tr data-track-url="{{ url('storage/'.$track->file) }}" data-track-id="{{ $track->id }}"  x-on:click="$wire.item_play='{{ $track->id }}'">
                    <td class="num">{{ $i }}</td>
                    <td class="title">{{ $track->translate(App::getLocale())->name }}</td>
                    <td class="zone">{{ $track->geographicalArea->translate(App::getLocale())->name }}</td>
                    <td class="year">{{ $track->year }}</td>
                    <td class="time">{{ $track->duration }}</td>
                    <td class="actions">
                        <button wire:click.stop="$dispatch('delete-to-playlist', { id: {{ $track->id }} })">
                            Delete
                        </button>
                    </td>
                </tr>
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
        // on the page...
            
        let links = document.querySelectorAll('#playlist tr');
        window.loadLinkList(links) ;
        if ( '{{ $item_play}}' != 'none') {
            console.log('{{ $item_play}}') ;
            window.playLinkToList({{ $item_play}}) ;
        }
    })
</script>
@endscript