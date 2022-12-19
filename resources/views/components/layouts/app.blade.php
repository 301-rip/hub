<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('pageTitle') - 301 R.I.P.</title>
        
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="m-0 p-0 bg-gray-100 flex min-h-screen items-start justify-center">
        <div class="bg-white rounded-lg shadow p-6 my-12 border">
            {{ $slot ?? '' }}
        </div>
        @stack('js')
        @routes
    </body>
</html>
