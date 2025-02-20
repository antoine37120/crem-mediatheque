<x-layouts.app>
    <x-slot:meta_title>
    {{ __('pages.home.meta.title') }}
    </x-slot>
    <x-slot:title>
        <h1 class="page-title px-4 pb-5" >{{ __('pages.home.title') }}</h1>
    </x-slot>

    <livewire:tracks.list-home />

    <livewire:playlists.list-home />

     <livewire:podcasts.list-home />

</x-layouts.app>
