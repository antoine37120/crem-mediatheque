<div>
    <div x-data="trackinfos_{{ $track->id }}">
        <button x-on:click="addtolist" type="button" class="btn btn-light rounded-circle">+</button>
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

