<x-layouts.app>
    <x-slot:meta_title>
    {{ __('pages.podcasts.meta.title') }}
    </x-slot>
    <x-slot:title>
        <h1 class="page-title px-4">{{ __('pages.podcasts.title') }}</h1>
    </x-slot>

    <livewire:podcasts.list-self />

</x-layouts.app>
