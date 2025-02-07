<x-layouts.app>
    <x-slot:meta_title>
        {{ $playlist->translate(App::getLocale(), true)->name }}
    </x-slot>
    <x-slot:title>
        <livewire:playlists.section-title :playlist="$playlist" :key="'playlists-section-title-'.$playlist->id"/>
    </x-slot>

    <livewire:playlists.full-playlist :playlist="$playlist" :key="'playlists-full-playlist-'.$playlist->id"/>

</x-layouts.app>
