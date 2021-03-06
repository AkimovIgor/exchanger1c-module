<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Exchanger1C</title>

       {{-- Laravel Mix - CSS File --}}
        <link rel="stylesheet" href="{{ mix('css/exchanger1c.css') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.css" />
        <link href="{{ Module::asset('exchanger1c:css/glyphicons.css') }}" rel="stylesheet">
        <link href="{{ Module::asset('exchanger1c:css/main.css') }}" rel="stylesheet">

    </head>
    <body>
        @yield('content')


        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="{{  Module::asset('exchanger1c:js/main.js') }}"></script>

        {{-- Laravel Mix - JS File --}}
         <script src="{{ mix('js/exchanger1c.js') }}"></script>
    </body>
</html>
