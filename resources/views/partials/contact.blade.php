{{-- CONTACT: invitation panel with contact methods and social links. --}}
<section id="contact" class="section bg-zinc-50 dark:bg-zinc-900/40">
    <div class="container-site">
        <div class="reveal card mx-auto max-w-3xl px-6 py-14 text-center shadow-soft dark:shadow-soft-dark sm:px-12">
            <x-section-heading eyebrow="Get in touch" title="Let&rsquo;s work together" align="center" />

            <p class="lead mx-auto max-w-xl text-zinc-600 dark:text-zinc-400">
                Have a project in mind, a question about my work, or just want to say hi?
                My inbox is always open — I&rsquo;ll get back to you as soon as I can.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="mailto:{{ $profile['email'] }}" class="btn btn-primary">
                    <x-icon name="send" class="h-4 w-4" />
                    Say hello
                </a>
                <a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                    <x-icon name="github" class="h-4 w-4" />
                    Follow on GitHub
                </a>
            </div>

            {{-- Contact methods --}}
            <div class="mt-14 grid gap-8 sm:grid-cols-3">
                <div>
                    <p class="eyebrow">Email</p>
                    <a href="mailto:{{ $profile['email'] }}"
                       class="mt-2 inline-block break-all font-medium text-zinc-800 transition hover:text-indigo-600 dark:text-zinc-200 dark:hover:text-indigo-400">
                        {{ $profile['email'] }}
                    </a>
                </div>
                <div>
                    <p class="eyebrow">Phone</p>
                    @if (!empty($profile['phone']))
                        <a href="tel:{{ preg_replace('/[^+\d]/', '', $profile['phone']) }}"
                           class="mt-2 inline-block font-medium text-zinc-800 transition hover:text-indigo-600 dark:text-zinc-200 dark:hover:text-indigo-400">
                            {{ $profile['phone'] }}
                        </a>
                    @else
                        <p class="mt-2 font-medium text-zinc-400 dark:text-zinc-500">On request</p>
                    @endif
                </div>
                <div>
                    <p class="eyebrow">Location</p>
                    <p class="mt-2 font-medium text-zinc-800 dark:text-zinc-200">{{ $profile['location'] }}</p>
                </div>
            </div>

            {{-- Social links --}}
            <div class="mt-12 flex items-center justify-center gap-3">
                <a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer" class="icon-btn"
                   aria-label="GitHub profile" title="GitHub">
                    <x-icon name="github" />
                </a>
                <a href="{{ $profile['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="icon-btn"
                   aria-label="LinkedIn profile" title="LinkedIn">
                    <x-icon name="linkedin" />
                </a>
                <a href="mailto:{{ $profile['email'] }}" class="icon-btn" aria-label="Send an email" title="Email">
                    <x-icon name="mail" />
                </a>
            </div>
        </div>
    </div>
</section>
