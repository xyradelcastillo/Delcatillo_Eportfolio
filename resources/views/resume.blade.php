<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume | {{ $profile['name'] }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/c_logo.png') }}">
    <script>
        (function () {
            try {
                var theme = localStorage.getItem('theme');
                if (theme !== 'light' && theme !== 'dark') {
                    theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                document.documentElement.classList.toggle('dark', theme === 'dark');
            } catch (e) {}
        })();
    </script>
    @vite(['resources/css/app.css'])
    <style>
        html, body { margin: 0; padding: 0; height: 100%; overflow: hidden; }
    </style>
</head>
<body class="flex h-screen flex-col bg-zinc-50 dark:bg-zinc-900">

    {{-- Top toolbar --}}
    <div class="flex shrink-0 items-center justify-between border-b border-zinc-200 bg-white px-4 py-2 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
        <a href="#home" onclick="history.back()" class="flex items-center gap-2 text-base font-semibold text-zinc-700 transition hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Back
        </a>

        <h1 class="text-base font-bold text-zinc-900 dark:text-white">{{ $profile['name'] }} — Resume</h1>

        <div class="flex items-center gap-3">
            <a href="{{ asset('files/My Resume.pdf') }}" download
               class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition hover:bg-indigo-700 hover:shadow-lg dark:bg-indigo-500 dark:hover:bg-indigo-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5M12 15V3"/></svg>
                Download
            </a>
            <button onclick="document.getElementById('pdf-viewer').contentWindow.print()"
                    class="inline-flex items-center gap-2 rounded-xl border-2 border-indigo-600 px-5 py-2.5 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-50 dark:border-indigo-400 dark:text-indigo-300 dark:hover:bg-indigo-950">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                Print
            </button>
        </div>
    </div>

    {{-- PDF viewer --}}
    <iframe id="pdf-viewer"
            src="{{ asset('files/My Resume.pdf') }}"
            class="flex-1 w-full border-0"
            title="Resume viewer">
    </iframe>

</body>
</html>
