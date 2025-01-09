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

            {{-- Top menu for mobile only --}}
            {{-- <div class="main d-block d-lg-none" style="background-color: transparent ">
                <livewire:menu.top-menu/>
            </div> --}}

            <div class="row vh-100">
                <div id="side-menu" class="d-none d-lg-block col-lg-3 col-xl-2 ox-auto h-100 bg-white border-dark border-end">
                    <livewire:menu.side-menu />
                </div>
                <div class="primary-section col-12 col-lg-9 col-xl-10 ox-auto pb-1">
                    {{-- desktop --}}
                    <header class="d-none d-lg-block py-4 px-1 text-white">
                        {{ $title ?? 'Page Title' }}
                    </header>
                    {{-- mobile --}}
                    <div class="d-flex flex-row justify-content-between d-lg-none py-4 px-1 text-white" id="header-mobile">
                        <div class="py-3 max-h-fit" id="page-title-mobile">
                            {{ $title ?? 'Page Title' }}
                        </div>
                        <div class="max-h-fit" id="logo-mobile">
                            <img src="/storage/logos/logo-musicoologieVOK.jpg" alt="" class="h-50 py-3 w-30"></img>
                        </div>
                    </div>


                    {{-- Main --}}
                    <div class="main-of-page pe-3">{{ $slot }}</div>
                    {{-- Player --}}
                    <div class="footer-wrapper position-fixed col-lg-9 col-xl-10 bottom-0 pe-3 pe-lg-0">
                        <div class="player-section position-relative mx-2 mx-lg-0">
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

            {{-- <div class="row vh-20 position-relative">
                <div class="col-12 p-0">
                </div>
            </div> --}}



        </div>
    </body>
</html>
