<x-layouts.app>
    <x-slot:title>
        <h1 class="pb-5">{{ $page->translate(App::getLocale(), true)->name }}</h1>
    </x-slot>

    {!! $page->translate(App::getLocale(), true)->content !!}

    </x-layouts.app>
