
<html>
    <head>
        
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body id="body-wave">
        <script>
                
            window.onload = function() {
                genrateWave("{{ url('storage/'.$file) }}", 600, NaN, NaN) ;
                sleep(100) ;
            };
                

        </script>
        <img src="" style="width: 100%;Height:600px;"/> 
    </body>
</html>