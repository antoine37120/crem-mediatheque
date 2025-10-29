<div x-data="{
    isTouchDevice: false,
    init() {
        // Détection des écrans tactiles
        this.isTouchDevice = ('ontouchstart' in window) ||
                            (navigator.maxTouchPoints > 0) ||
                            (navigator.msMaxTouchPoints > 0);
    }
}">
    <h2 class="px-4 pb-0 fw-bold"><a href="{{route('tracks')}}" class="text-black text-decoration-none" wire:navigate>{{ __('pages.tracks.home-section-title') }}</a></h2>
    <div class="row align-items-start g-2 mb-4 home-tracks m-0"
         :class="{ 'flex-nowrap is-scroll-x': isTouchDevice }"
         x-bind:style="isTouchDevice ? 'overflow-x: auto;' : ''">
        @foreach ($tracks as $track)
            <div class="ps-1"
                 :class="isTouchDevice ? 'col-3' : 'col-md-4 col-xl-3'"
                 x-bind:style="isTouchDevice ? 'min-width: 250px;' : ''">
                <livewire:tracks.teaser-home :track="$track" wire:key="audio-{{ $track->id }}" />
            </div>
        @endforeach
    </div>
</div>
