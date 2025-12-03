<x-layouts.app>
    <x-slot:meta_title>
    {{ __('pages.home.meta.title') }}
    </x-slot>
    <x-slot:title>
        <h1 class="page-title px-4 pb-2 d-none d-sm-block" >{{ __('pages.home.title') }}</h1>
        <div class="px-4 pb-5 h3" >{{ __('pages.home.baseline') }}</div>
    </x-slot>

    <livewire:tracks.list-home />

    <livewire:playlists.list-home />

     <livewire:podcasts.list-home />

</x-layouts.app>
