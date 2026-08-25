{{-- Sticky top navigation: anchor links, theme toggle (always visible) and a mobile hamburger menu. --}}
<header id="navbar" class="fixed inset-x-0 top-0 z-50 border-b border-transparent bg-white/70 backdrop-blur-md transition-all duration-300 dark:bg-zinc-950/70">
    <nav class="container-site flex h-16 items-center justify-between" aria-label="Main navigation">
        {{-- Logo / monogram --}}
        <a href="#home" class="font-display text-xl font-bold tracking-tight text-zinc-900 dark:text-white">
            {{ $profile['initials'] }}<span class="text-indigo-600 dark:text-indigo-400">.</span>
        </a>

        {{-- Desktop anchor links (labels double as browser-tab titles per section) --}}
        <div class="hidden items-center gap-1 md:flex">
            @foreach (['Home' => '#home', 'About' => '#about', 'Education' => '#education', 'Projects' => '#projects', 'Contact' => '#contact'] as $label => $href)
                <a href="{{ $href }}" data-navlink
                   class="rounded-full px-4 py-2 text-sm font-medium text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/70 dark:hover:text-white">
                    <i class="fa-solid fa-{{ match($label) { 'Home' => 'house', 'About' => 'user', 'Education' => 'graduation-cap', 'Projects' => 'briefcase', 'Contact' => 'envelope' } }} mr-1 text-xs"></i>{{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Right side: accent-color picker + theme toggle (both always visible) + hamburger --}}
        <div class="flex items-center gap-2">
            {{-- Accent color picker --}}
            <div class="relative">
                <button type="button" id="accent-toggle"
                        class="icon-btn !border-transparent hover:!border-indigo-500 dark:hover:!border-indigo-400"
                        aria-label="Change accent color" title="Change accent color" aria-expanded="false" aria-controls="accent-menu">
                    <x-icon name="palette" />
                </button>

                <div id="accent-menu" role="radiogroup" aria-label="Accent color"
                     class="invisible absolute right-0 top-full z-50 mt-2 w-44 translate-y-1 scale-95 opacity-0 rounded-2xl border border-zinc-200 bg-white p-2 shadow-lg transition duration-200 dark:border-zinc-700 dark:bg-zinc-900">
                    @foreach (['indigo', 'violet', 'emerald', 'rose', 'amber', 'sky'] as $key)
                        <button type="button" data-accent-choice="{{ $key }}" role="radio" aria-checked="{{ $key === 'indigo' ? 'true' : 'false' }}"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium capitalize text-zinc-700 transition hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800">
                            <span class="swatch swatch-{{ $key }} relative flex h-5 w-5 shrink-0 items-center justify-center rounded-full shadow-sm ring-2 ring-white/80 dark:ring-zinc-800">
                                <x-icon name="check" class="check h-3 w-3 text-white opacity-0 transition" />
                            </span>
                            {{ $key }}
                        </button>
                    @endforeach
                </div>
            </div>

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
                    <i class="fa-solid fa-{{ match($label) { 'About' => 'user', 'Education' => 'graduation-cap', 'Projects' => 'briefcase', 'Contact' => 'envelope' } }} mr-2 text-sm"></i>{{ $label }}
                </a>
            @endforeach
        </div>
    </div>
</header>
