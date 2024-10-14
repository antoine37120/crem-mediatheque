<div>
    {{-- The Master doesn't talk, he acts. --}}
    {{-- <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="display-5 fw-bold text-body-emphasis">Hum, nous y sommes !</h1>
        <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
            <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
        </div>
        </div>
    </div> --}}

{{--     <div class="container py-4">
        <div class="pb-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                <span class="fs-4">Laracoding.com Tutorial</span>
            </a>
        </div>
    </div> --}}


    <div class="container-fluid p-2 bg-gradient" style="background-size: 100% 30vh; background-repeat: no-repeat; background-color: red">
        <div class="row fixed-top" style="color: green; height: 20vh"></div>
        {{-- heading background linear gradient --}}
        {{-- <div class="bg-gradient" style="heignt: 300px"></div> --}}

        {{-- Top menu for mobile only --}}
        <div class="main d-md-none" style="background-color: transparent ">
            <livewire:menu.top-menu/>
        </div>

        {{-- Bottom menu for mobile --}}
        <div class="row main d-md-none">
            <livewire:menu.bottom-menu/>
        </div>


        {{-- Global menu left column for desktop only --}}
        <div class="row main d-none d-md-block">
            <div class="col-2 p-2 bg-white">
                {{-- .col-9 --}}
                {{-- <livewire:menu.menu /> --}}
                <div class="p-2">
                    <img src="/storage/logos/LESC-CREM_Long.png" alt="Logo CREM" class="mw-100">
                </div>
                <hr class="w-70 text-dark"/>
                <div>
                    <livewire:menu.side-menu/>
                </div>
                <div class="mh-100">
                    <livewire:menu.logos-partners />
                </div>
                <div class="p-2">
                    Mentions légales
                </div>
            </div>

            <div class="col-10">
                {{-- .col-4<br>Since 9 + 4 = 13 &gt; 12, this 4-column-wide div gets wrapped onto a new line as one contiguous unit. --}}
                {{-- <livewire:audio-item.listing /> --}}
            </div>
        </div> <!--row main-->
        <div class="row player">

        </div> <!--row player-->
    </div> <!--container-fluid-->

</div>
