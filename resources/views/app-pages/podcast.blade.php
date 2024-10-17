<x-layouts.app>
    <x-slot:title>
        <livewire:podcast.section-title :podcast="$podcast"  wire:key="title-{{ $podcast->id }}"/>
    </x-slot>

    <livewire:playlist.full-playlist :playlist="$playlist"/>

</x-layouts.app>
