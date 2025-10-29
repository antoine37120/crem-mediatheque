<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('front.meta_title_prefix') }} - {{ $meta_title ?? 'Page Title' }}</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>

    <body class="{{ str_replace('.', ' ', request()->route()->getName()) }}">
        <div class="container-fluid p-0">

            <div class="row m-0 justify-content-end">
                <div id="side-menu" class="d-none d-lg-block col-lg-3 col-xxl-2 vh-100 bg-white p-0 position-fixed top-0 start-0">

                    <div class="overflow-y-scroll vh-100 border-dark border-end" wire:scroll>
                        <livewire:menu.side-menu />
                    </div>

                </div>
                <div class="primary-section col-12 col-lg-9 col-xxl-10">

                    <header id="header-mobile" class="row py-4 text-white m-0 pb-4">
                        <div class="col-9 col-lg-12 py-0 px-lg-2 h5" id="page-title-mobile">
                            {{ $title ?? 'Page Title' }}
                        </div>
                        <div class="col-3 d-lg-none" id="logo-mobile">
                            <img src="/storage/logos/logo-musicoologieVOK.jpg" alt="" class="w-100"></img>
                        </div>
                    </header>
                    {{-- Main --}}
                    <div class="main-of-page p-2">{{ $slot }}</div>
                    {{-- Player --}}
                    <div class="footer-wrapper position-fixed col-12 col-lg-9 col-xxl-10 bottom-0 end-0 p-0">
                        <div class="player-section position-relative mx-0">
                        @persist('player')
                        <livewire:player.commands />
                        @endpersist
                        </div>
                        {{-- Bottom menu for mobile --}}
                        <div class="main d-block d-lg-none position-relative mx-lg-0">
                            <livewire:menu.bottom-menu/>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
