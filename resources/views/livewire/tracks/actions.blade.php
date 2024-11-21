<div>
    <div x-data="trackinfos_{{ $track->id }}">
        <button x-on:click="addtolist" type="button" class="btn btn-light rounded-circle p-0 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
        </button>
    </div>
</div>

@script
<script>
    Alpine.data('trackinfos_{{ $track->id }}', () => {
        return {
            track: {
                title: "{{ $track->translate(App::getLocale(), true)->name }}",
                fileUrl: "{{ url('storage/'.$track->file) }}",
                zone: "{{ $track->geographicalArea->translate(App::getLocale(), true)->name }}",
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

