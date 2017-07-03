<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Stock Chat</title>

        {{-- Styles --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="wrapper">
            {{-- Navbar --}}
        </div>

        <div class="body">
            @yield('content')
        </div>

        <div class="footer">
            <div class="container-fluid">

            </div>
        </div>

        {{-- Scripts --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
