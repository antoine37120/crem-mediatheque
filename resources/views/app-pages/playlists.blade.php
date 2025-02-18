<x-layouts.app>
    <x-slot:meta_title>
    {{ __('pages.playlists.meta.title') }}
    </x-slot>
    <x-slot:title>
        <h1 class="page-title px-4">{{ __('pages.playlists.title') }}</h1>
    </x-slot>

    <livewire:playlists.list-self />

</x-layouts.app>
