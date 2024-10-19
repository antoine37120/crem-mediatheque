<x-layouts.app>
    <x-slot:title>
        <livewire:playlists.section-title :playlist="$playlist"  wire:key="title-{{ $playlist->id }}"/>
    </x-slot>

    <livewire:playlists.full-playlist :playlist="$playlist"/>

</x-layouts.app>
