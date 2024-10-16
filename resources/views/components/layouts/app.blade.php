<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>


        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    </head>

    <body class="{{ str_replace('.', ' ', request()->route()->getName()) }}">
        <div class="container-fluid">
            <div class="row vh-80">
                <div class="col-2 bg-white border-dark border-end">

                <livewire:menu.side-menu />


                </div>
                <div class="primary-section col-10 ox-auto h-100 pb-5">
                    <header class="py-4 px-1 text-white">{{ $title ?? 'Page Title' }}</header>
                    {{ $slot }}

                </div>
            </div>
            <div class="row vh-20 position-relative">
                <div class="col-12">
                @persist('player')
                <livewire:player.commands />

                @endpersist
                </div>


            </div>
        </div>
    </body>
</html>
