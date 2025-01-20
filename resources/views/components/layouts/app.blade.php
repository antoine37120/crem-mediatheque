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
                    <header id="header-mobile" class="position-fixed w-100 top-0 d-flex flex-row justify-content-between d-lg-none py-4 px-1 text-white" style="height: 200px; z-index: 999">
                        <div class="py-3 max-h-fit" id="page-title-mobile">
                            {{ $title ?? 'Page Title' }}
                        </div>
                        <div class="max-h-fit d-flex" id="logo-mobile">
                            <img src="/storage/logos/logo-musicoologieVOK.jpg" alt="" class="h-100 px-4 py-3 w-30"></img>
                        </div>
                    </header>

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
        {{-- <script type="text/javascript">

            // VERSION 3
            $(function(){
                var lastScrollTop = 0, delta = 15;
                $(window).scroll(function(event){
                var st = $(this).scrollTop();

                if(Math.abs(lastScrollTop - st) <= delta)
                    return;
            if ((st > lastScrollTop) && (lastScrollTop>0)) {
                // downscroll code
                $("header").css("top","-80px");

            } else {
                // upscroll code
                $("header").css("top","0px");
            }
                lastScrollTop = st;
                });
            });
        </script> --}}

    </body>
</html>
