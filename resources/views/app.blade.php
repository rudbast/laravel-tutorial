<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Document</title>
        <!-- Twitter bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-theme.min.css') }}"/> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"/>

        <style>
            body {
                width: 100%;
                height: 100%;
                padding: 60px 50px 20px 50px;
                font-family: "Trebuchet MS", Helvetica, sans-serif;
            }
        </style>
    </head>
    <body>
        <header>
            @include('partials.nav')
        </header>

        <div class="container">
            @include('partials.flash')

            @yield('content')
        </div>

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/select2.min.js') }}"></script>
        <script type="text/javascript">
            $('div.alert').not('.alert-important').delay(3000).slideUp(300);
        </script>

        @yield('footer')
    </body>
</html>
