<!DOCTYPE html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" lang="fa" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'بلاگ من')</title>
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
          @livewireStyles
          @trixassets
    </head>
    <body class="antialiased" dir="rtl">
        

       @livewire('layouts.header')
       {{$slot}}
       @livewire('layouts.footer')

       @livewireScripts
    </body>
</html>
