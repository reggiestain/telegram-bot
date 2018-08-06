<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login V12</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/icon-font.min.css') }}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="{{ asset('css/hamburgers.min.css') }}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
        <!--===============================================================================================-->
    </head>
    <body> 

        <div class="limiter">
            @yield('content')		
        </div>

        <!--===============================================================================================-->	
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <!--===============================================================================================-->
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!--===============================================================================================-->
        <script src="{{ asset('js/elect2.min.js') }}"></script>
        <!--===============================================================================================-->
        <script src="{{ asset('js/main.js') }}"></script>

    </body>
</html>