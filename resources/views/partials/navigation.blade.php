{{-- Sticky top navigation: anchor links, theme toggle (always visible) and a mobile hamburger menu. --}}
<header id="navbar" class="fixed inset-x-0 top-0 z-50 border-b border-transparent bg-white/70 backdrop-blur-md transition-all duration-300 dark:bg-zinc-950/70">
    <nav class="container-site flex h-16 items-center justify-between" aria-label="Main navigation">
        {{-- Logo / monogram --}}
        <a href="#home" class="font-display text-xl font-bold tracking-tight text-zinc-900 dark:text-white">
            {{ $profile['initials'] }}<span class="text-indigo-600 dark:text-indigo-400">.</span>
        </a>

        {{-- Desktop anchor links --}}
        <div class="hidden items-center gap-1 md:flex">
            @foreach (['About' => '#about', 'Education' => '#education', 'Projects' => '#projects', 'Contact' => '#contact'] as $label => $href)
                <a href="{{ $href }}" data-navlink
                   class="rounded-full px-4 py-2 text-sm font-medium text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/70 dark:hover:text-white">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Right side: theme toggle (visible on all screen sizes) + hamburger --}}
        <div class="flex items-center gap-2">
            <button type="button" id="theme-toggle" class="icon-btn !border-transparent hover:!border-indigo-500 dark:hover:!border-indigo-400"
                    aria-label="Toggle dark mode" title="Toggle dark mode">
                <x-icon name="sun" class="h-5 w-5 dark:hidden" />
                <x-icon name="moon" class="hidden h-5 w-5 dark:block" />
            </button>

            <button type="button" id="menu-toggle"
                    class="icon-btn !border-transparent hover:!border-indigo-500 dark:hover:!border-indigo-400 md:hidden"
                    aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
                <x-icon name="menu" class="menu-open h-5 w-5" />
                <x-icon name="x" class="menu-close hidden h-5 w-5" />
            </button>
        </div>
    </nav>

    {{-- Mobile dropdown panel --}}
    <div id="mobile-menu" class="hidden border-t border-zinc-200/80 bg-white/95 backdrop-blur-md dark:border-zinc-800/80 dark:bg-zinc-950/95 md:hidden">
        <div class="container-site flex flex-col py-3">
            @foreach (['About' => '#about', 'Education' => '#education', 'Projects' => '#projects', 'Contact' => '#contact'] as $label => $href)
                <a href="{{ $href }}" data-navlink-mobile
                   class="rounded-lg px-4 py-3 text-base font-medium text-zinc-700 transition hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800/70 dark:hover:text-white">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>
</header>
