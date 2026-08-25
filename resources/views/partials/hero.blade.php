{{-- HERO / Basic information: name, tagline, avatar, short bio, contact links, primary CTA. --}}
<section id="home" class="relative flex min-h-screen items-center overflow-hidden pt-28 pb-20">
    {{-- Decorative background blobs (subtle in both themes) --}}
    <div class="pointer-events-none absolute inset-0 -z-10" aria-hidden="true">
        <div class="absolute -top-32 right-0 h-96 w-96 rounded-full bg-indigo-500/10 blur-3xl dark:bg-indigo-500/15"></div>
        <div class="absolute bottom-0 left-0 h-80 w-80 rounded-full bg-violet-500/10 blur-3xl dark:bg-violet-500/10"></div>
    </div>

    <div class="container-site grid items-center gap-14 lg:grid-cols-12">
        <div class="lg:col-span-7">
            @if (!empty($profile['availability']))
                <p class="reveal inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-4 py-1.5 text-xs font-medium text-emerald-700 dark:text-emerald-400">
                    <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-500"></span>
                    {{ $profile['availability'] }}
                </p>
            @endif

            <h1 class="reveal mt-6 font-display text-4xl font-bold leading-tight tracking-tight text-zinc-900 dark:text-white sm:text-5xl lg:text-6xl" style="transition-delay: 80ms">
                Hi, I&rsquo;m {{ $profile['name'] }}.
                <span class="mt-2 block text-indigo-600 dark:text-indigo-400">{{ $profile['role'] }}</span>
            </h1>

            <p class="lead reveal max-w-xl text-zinc-600 dark:text-zinc-400" style="transition-delay: 160ms">
                {{ $profile['headline'] }} {{ $profile['bio_short'] }}
            </p>

            <div class="reveal mt-8 flex flex-wrap items-center gap-4" style="transition-delay: 240ms">
                <a href="#projects" class="btn btn-primary">
                     <x-icon name="arrow-down" class="h-4 w-4" />
                    View my work
                </a>
                <a href="#contact" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i> Get in touch</a>
                @if (!empty($profile['resume']))
                    <a href="{{ $profile['resume'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                        <x-icon name="eye" class="h-4 w-4" />
                        Resume
                    </a>
                @endif
            </div>

            <div class="reveal mt-8 flex items-center gap-3" style="transition-delay: 320ms">
                 <!--  <a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer" class="icon-btn"
                   aria-label="GitHub profile" title="GitHub">
                    <x-icon name="github" />
                </a>
                @foreach ($profile['socials'] as $social)
                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="icon-btn"
                       aria-label="{{ $social['label'] }} profile" title="{{ $social['label'] }}">
                        <x-icon name="{{ $social['icon'] }}" />
                    </a>
                @endforeach
                <a href="mailto:{{ $profile['email'] }}" class="icon-btn" aria-label="Send an email" title="Email">
                    <x-icon name="mail" />
                </a>
                @if (!empty($profile['phone']))
                 <a href="tel:{{ preg_replace('/[^+\d]/', '', $profile['phone']) }}" class="icon-btn"
                       aria-label="Call me" title="Phone">
                        <x-icon name="phone" />
                    </a> -->
                @endif
                <span class="ml-1 hidden items-center gap-1.5 text-sm text-zinc-500 dark:text-zinc-400 sm:inline-flex">
                    <x-icon name="map-pin" class="h-4 w-4" /> {{ $profile['location'] }}
                </span>
            </div>
        </div>

        {{-- Circular profile picture --}}
            <div class="reveal group flex justify-center lg:col-span-5" style="transition-delay: 200ms">
            <div class="relative">
                <div class="absolute -inset-6 -z-10 rotate-6 rounded-[2.5rem] bg-gradient-to-br from-indigo-500/25 via-violet-500/20 to-transparent blur-sm transition-transform duration-500 group-hover:rotate-12" aria-hidden="true"></div>
                <img src="{{ $profile['avatar'] }}" alt="Portrait of {{ $profile['name'] }}"
                     width="320" height="320"
                     class="h-64 w-64 rounded-full object-cover shadow-soft ring-4 ring-indigo-500/25 sm:h-80 sm:w-80 dark:shadow-soft-dark dark:ring-indigo-400/25">
            </div>
        </div>
    </div>

    {{-- Scroll cue --}}
    <a href="#about" class="absolute bottom-8 left-1/2 hidden -translate-x-1/2 flex-col items-center gap-1 text-xs font-medium text-zinc-400 transition hover:text-indigo-600 dark:text-zinc-500 dark:hover:text-indigo-400 md:flex" aria-label="Scroll to about section">
        Scroll
        <x-icon name="arrow-down" class="h-4 w-4 animate-bounce" />
    </a>
</section>
