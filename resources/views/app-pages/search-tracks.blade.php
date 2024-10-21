<x-layouts.app>
    <x-slot:title>
        <h1 class="pb-5" >Search : {{ request('q') }}</h1>
    </x-slot>

    <livewire:tracks.search />


</x-layouts.app>
