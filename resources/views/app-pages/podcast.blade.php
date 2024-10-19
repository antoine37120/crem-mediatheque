<x-layouts.app>
    <x-slot:title>
        <livewire:podcasts.section-title :podcast="$podcast"  wire:key="title-{{ $podcast->id }}"/>
    </x-slot>

    <livewire:podcasts.full-podcast :podcast="$podcast"/>

</x-layouts.app>
