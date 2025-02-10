<x-layouts.app>
    <x-slot:meta_title>
        {{ $page->translate(App::getLocale(), true)->name }}
    </x-slot>
    <x-slot:title>
        <h1 class="page-title px-4 pb-5">{{ $page->translate(App::getLocale(), true)->name }}</h1>
    </x-slot>

    {!! $page->translate(App::getLocale(), true)->content !!}

    </x-layouts.app>
