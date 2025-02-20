<x-layouts.app>
    <x-slot:meta_title>
        @if(request('q'))
        {{ __('pages.tracks.meta.title_prefix') }} {{ request('q') }}
        @else
        {{ __('pages.tracks.meta.title') }}     
        @endif
    </x-slot>
    <x-slot:title>
        <h1 class="page-title px-4" >
            @if(request('q'))
            {{ __('pages.tracks.title_prefix') }} {{ request('q') }}
            @else
            {{ __('pages.tracks.title') }}     
            @endif
        </h1>
    </x-slot>

    <livewire:tracks.search />


</x-layouts.app>
