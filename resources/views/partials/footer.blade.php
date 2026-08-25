{{-- Footer: contact summary, quick links, social icons and back-to-top. --}}
<footer class="border-t border-zinc-200 py-10 dark:border-zinc-800">
    <div class="container-site flex flex-col items-center justify-between gap-6 sm:flex-row">
        <div class="text-center sm:text-left">
            <p class="font-display text-base font-semibold text-zinc-900 dark:text-white">{{ $profile['name'] }}</p>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
              &copy; {{ date('Y') }} · All Rights Reserved  <!--  Built with Laravel &amp; Tailwind CSS -->
            </p>
        </div>

        <p class="hidden text-sm text-zinc-500 dark:text-zinc-400 lg:block">
            {{ $profile['location'] }}
        </p>

        <div class="flex items-center gap-3">
            <a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer" class="icon-btn h-9 w-9"
               aria-label="GitHub profile" title="GitHub">
                <x-icon name="github" class="h-4 w-4" />
            </a>
            @foreach ($profile['socials'] as $social)
                <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="icon-btn h-9 w-9"
                   aria-label="{{ $social['label'] }} profile" title="{{ $social['label'] }}">
                    <x-icon name="{{ $social['icon'] }}" class="h-4 w-4" />
                </a>
            @endforeach
            <a href="mailto:{{ $profile['email'] }}" class="icon-btn h-9 w-9"
               aria-label="Send an email" title="Email">
                <x-icon name="mail" class="h-4 w-4" />
            </a>
            <a href="#home" class="icon-btn h-9 w-9" aria-label="Back to top" title="Back to top">
                <x-icon name="arrow-down" class="h-4 w-4 rotate-180" />
            </a>
        </div>
    </div>
</footer>
