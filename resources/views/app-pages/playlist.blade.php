<x-layouts.app>
    <x-slot:title>
        <livewire:playlist.section-title :playlist="$playlist"  wire:key="title-{{ $playlist->id }}"/>
    </x-slot>

    <livewire:playlist.full-playlist :playlist="$playlist"/>

</x-layouts.app>
