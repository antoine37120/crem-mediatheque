<div>
    <div x-data="trackinfos_{{ $track->id }}">
        <button x-on:click="addtolist" type="button" class="btn btn-light rounded-circle p-1" style="line-hight:24px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg align-middle display-inline-block" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
        </button>
    </div>
</div>
 
@script
<script>
    Alpine.data('trackinfos_{{ $track->id }}', () => {
        return {
            track: {
                title: "{{ $track->translate(App::getLocale())->name }}",
                fileUrl: "{{ url('storage/'.$track->file) }}",
                zone: "{{ $track->geographicalArea->translate(App::getLocale())->name }}",
                year: "{{ $track->year }}",
                time: "{{ $track->duration }}"
            },
            addtolist() {
                $wire.dispatch('add-track-to-playlist',  { id: {{ $track->id }} });
                //window.addTrackToList(this.track) ;
            },
        }
    });
</script>
@endscript

