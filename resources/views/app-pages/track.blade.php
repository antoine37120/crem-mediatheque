<x-layouts.app>
    <x-slot:title>
        <livewire:tracks.section-title :track="$track"  wire:key="title-{{ $track->id }}"/>
    </x-slot>

    <livewire:tracks.full-track :track="$track"/>

</x-layouts.app>