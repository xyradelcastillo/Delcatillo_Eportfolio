{{-- CONTACT: contact info cards on the left, message form on the right
     (layout mirrors the original reference site, styled with this template's components).
     The form has no backend — submitting opens the visitor's mail app with the
     message pre-filled for {{ $profile['email'] }}. --}}
<section id="contact" class="section bg-zinc-50 dark:bg-zinc-900/40">
    <div class="container-site">
        <x-section-heading eyebrow="Get in touch" title="Contact me" align="center" />

     <!--   <p class="lead mx-auto mt-4 max-w-xl text-center text-zinc-600 dark:text-zinc-400">
            Have a question about my work, an opportunity, or just want to say hi?
            My inbox is always open — I&rsquo;ll get back to you as soon as I can.
        </p> -->

        <div class="mt-14 grid items-start gap-8 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Contact info cards --}}
                <div class="reveal card flex items-start gap-4 p-5 hover:-translate-y-1 hover:border-indigo-500/40 hover:shadow-md dark:hover:border-indigo-400/40">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400" aria-hidden="true">
                        <x-icon name="map-pin" class="h-5 w-5" />
                    </span>
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Address</h3>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $profile['location'] }}</p>
                    </div>
                </div>

                <div class="reveal card flex items-start gap-4 p-5 hover:-translate-y-1 hover:border-indigo-500/40 hover:shadow-md dark:hover:border-indigo-400/40">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400" aria-hidden="true">
                        <x-icon name="mail" class="h-5 w-5" />
                    </span>
                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Email</h3>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $profile['email'] }}" class="mt-1 block break-all text-sm text-zinc-500 transition hover:text-indigo-600 dark:text-zinc-400 dark:hover:text-indigo-400">
                            {{ $profile['email'] }}
                        </a>
                    </div>
                </div>

                <div class="reveal card flex items-start gap-4 p-5 hover:-translate-y-1 hover:border-indigo-500/40 hover:shadow-md dark:hover:border-indigo-400/40">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400" aria-hidden="true">
                        <x-icon name="phone" class="h-5 w-5" />
                    </span>
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Phone</h3>
                        @if (!empty($profile['phone']))
                            <a href="tel:{{ preg_replace('/[^+\d]/', '', $profile['phone']) }}" class="mt-1 block text-sm text-zinc-500 transition hover:text-indigo-600 dark:text-zinc-400 dark:hover:text-indigo-400">
                                {{ $profile['phone'] }}
                            </a>
                        @else
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">On request</p>
                        @endif
                    </div>
                </div>

                <div class="reveal card flex items-start gap-4 p-5 hover:-translate-y-1 hover:border-indigo-500/40 hover:shadow-md dark:hover:border-indigo-400/40">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400" aria-hidden="true">
                        <x-icon name="github" class="h-5 w-5" />
                    </span>
                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">GitHub</h3>
                        <a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer" class="mt-1 block break-all text-sm text-zinc-500 transition hover:text-indigo-600 dark:text-zinc-400 dark:hover:text-indigo-400">
                            {{ preg_replace('#^https?://(www\.)?#', '', $profile['github']) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

      <!--  {{-- Social links --}}
        <div class="mt-12 flex items-center justify-center gap-3">
            <a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer" class="icon-btn"
               aria-label="GitHub profile" title="GitHub">
                <x-icon name="github" />
            </a>
            @foreach ($profile['socials'] as $social)
                <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="icon-btn"
                   aria-label="{{ $social['label'] }} profile" title="{{ $social['label'] }}">
                    <x-icon name="{{ $social['icon'] }}" />
                </a>
            @endforeach
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $profile['email'] }}" class="icon-btn" aria-label="Send an email" title="Email">
                <x-icon name="mail" />
            </a>
        </div> -->
    </div>
</section>
