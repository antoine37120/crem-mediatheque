<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 vh-100 bg-secondary">.col-9

                <livewire:menu.side-menu />


                </div>
                <div class="col-10">.col-4<br>Since 9 + 4 = 13 &gt; 12, this 4-column-wide div gets wrapped onto a new line as one contiguous unit.
                    <h1>{{ $title ?? 'Page Title' }}</h1>
                    {{ $slot }} 
            
                </div>
            </div>
        </div>
    </body>
</html>
