<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- EDIT: page titles follow the "Page | Site name" pattern.
         Each view (or the scroll-spy in app.js, per section) can override the
         page part via @section('title', '...'). --}}
    <title>@yield('title', 'Home') | {{ $profile['name'] }}</title>
    <meta name="description" content="@yield('meta_description', $profile['bio_short'])">
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#ffffff">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#09090b">

    {{-- EDIT: swap public/images/c_logo.png to change the browser-tab icon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/c_logo.png') }}">

    {{-- Theme init: runs BEFORE first paint so there is no flash of the wrong theme.
         Reads the saved preference from localStorage, falls back to the OS setting.
         Also restores the accent-color choice (data-accent on <html>). --}}
    <script>
        (function () {
            try {
                var theme = localStorage.getItem('theme');
                if (theme !== 'light' && theme !== 'dark') {
                    theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                document.documentElement.classList.toggle('dark', theme === 'dark');

                var accents = ['indigo', 'violet', 'emerald', 'rose', 'amber', 'sky'];
                var accent = localStorage.getItem('accent');
                if (accents.indexOf(accent) !== -1) {
                    document.documentElement.setAttribute('data-accent', accent);
                }
            } catch (e) { /* no-op */ }
        })();
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col">
    <a href="#home" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[100] focus:rounded-full focus:bg-indigo-600 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-white">
        Skip to content
    </a>

    @include('partials.navigation')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
