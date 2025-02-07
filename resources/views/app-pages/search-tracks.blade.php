<x-layouts.app>
    <x-slot:meta_title>
        Search
    </x-slot>
    <x-slot:title>
        <h1 class="page-title px-4" >Search {{ request('q') }}</h1>
    </x-slot>

    <livewire:tracks.search />


</x-layouts.app>
