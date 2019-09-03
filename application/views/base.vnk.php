@php
    defined('BASEPATH') OR exit('No direct script access allowed');
@endphp
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{ css('bs.min.css') }}">
        <link rel="stylesheet" href="{{ css('fa.min.css') }}">
        @yield('additional_stylesheet')
        <title>
            {{ site_name() }} - {{ $title or 'Automation Engineering' }}
        </title>
    </head>
    <body class="nav-md footer_fixed">
        @yield('nav_unique')
        @yield('content_unique')
        @yield('footer_unique')
        @if (!isset($no_foot))
            <div class="container body">
                <div class="main_container">
                    @yield('sidebar')
                    @yield('nav')
                    @yield('content')
                    <footer>
                        <div class="pull-right">
                            {{ site_name() }}
                        </div>
                        <div class="clearfix"></div>
                    </footer>
                </div>
            </div>
        @endif
        <script src="{{ js('jquery.min.js') }}"></script>
        <script src="{{ js('bs.min.js') }}"></script>
        <script src="{{ js('fastclick.js') }}"></script>
        <script src="{{ js('esystemae.js') }}"></script>
        @yield('additional_script')
    </body>
</html>