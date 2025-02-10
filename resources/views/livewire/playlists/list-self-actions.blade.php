<div>
    <div class="d-flex column-gap-2 justify-content-end">
        <div x-data="trackinfos_playlist_{{ $playlist->id }}">
            <button x-on:click="addtolist" type="button" class="btn btn-light rounded-circle position-relative p-0 d-flex align-items-center justify-content-centere">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play-fill p-1" viewBox="0 0 16 16">
                    <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                </svg>
            </button>
        </div>
        <div x-data="trackinfos_playlist_random_{{ $playlist->id }}">
            <button x-on:click="addtolist" type="button" class="btn btn-light rounded-circle position-relative p-0 d-flex align-items-center justify-content-centere">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shuffle p-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.6 9.6 0 0 0 7.556 8a9.6 9.6 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.6 10.6 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.6 9.6 0 0 0 6.444 8a9.6 9.6 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5"/>
                    <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192"/>
                </svg>
            </button>
        </div>
    </div>
</div>



@script
<script>
    Alpine.data('trackinfos_playlist_{{ $playlist->id }}', () => {
        return {
            /*tracks: @json($audioItems) ,*/
            addtolist() {
                $wire.dispatch('add-playlist-to-playlist',  { id: {{ $playlist->id }} });
                console.log('added')
                //window.addTrackToList(this.track) ;
            },
        }
    });
    Alpine.data('trackinfos_playlist_random_{{ $playlist->id }}', () => {
        return {
            /*tracks: @json($audioItems) ,*/
            addtolist() {
                $wire.dispatch('add-playlist-to-playlist-random',  { id: {{ $playlist->id }} });
                console.log('added')
                //window.addTrackToList(this.track) ;
            },
        }
    });
</script>
@endscript
