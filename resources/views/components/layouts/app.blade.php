<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('pageTitle') - 301 R.I.P.</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="m-0 p-0 bg-slate-700 flex flex-col min-h-screen  items-center justify-center">
        <div class="flex flex-col items-center justify-center">
            @svg('mammoth2', 'h-48')
            <div class="w-90% max-w-xl relative my-12 before:absolute before:left-4 before:top-4 before:w-full before:h-full before:z-20 before:rounded-lg before:bg-gradient-to-tl before:from-cyan-400 before:to-indigo-500">
                <div {{ $attributes->class('relative shadow bg-slate-100 rounded-lg shadow px-8 py-8 border-black z-30') }}>
                    {{ $slot ?? '' }}
                </div>
            </div>
        </div>
        @stack('js')
    </body>
</html>
