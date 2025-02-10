<x-layouts.app>
    <x-slot:meta_title>
        {{ $podcast->translate(App::getLocale(), true)->name }}
    </x-slot>
    <x-slot:title>
        <livewire:podcasts.section-title :podcast="$podcast"  wire:key="podcast-title-{{ $podcast->id }}"/>
    </x-slot>

    <livewire:podcasts.full-podcast :podcast="$podcast"/>

</x-layouts.app>
