<x-layouts.app>
    <x-slot:meta_title>
        {{ $track->translate(App::getLocale(), true)->name }}
    </x-slot>
    <x-slot:title>
        <livewire:tracks.section-title :track="$track" :playlist_id="$playlist_id"  wire:key="track-title-{{ $track->id }}"/>
    </x-slot>

    <livewire:tracks.full-track :track="$track" :playlist_id="$playlist_id" />

</x-layouts.app>
