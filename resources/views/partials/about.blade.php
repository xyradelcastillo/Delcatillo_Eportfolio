{{-- ABOUT: short bio next to a portrait image + row of quick stats. --}}
<section id="about" class="section">
    <div class="container-site">
        <x-section-heading eyebrow="Who I am" title="About me" />

        <div class="mt-14 grid items-start gap-12 lg:grid-cols-5">
            {{-- Portrait --}}
            <figure class="reveal lg:col-span-2">
                <div class="card group overflow-hidden p-0 shadow-soft dark:shadow-soft-dark">
                    <img src="{{ $profile['avatar'] }}" alt="Portrait of {{ $profile['name'] }}"
                         width="480" height="600" loading="lazy"
                         class="aspect-[4/5] w-full object-cover transition duration-500 group-hover:scale-[1.03]">
                </div>
                <figcaption class="mt-4 text-center text-sm text-zinc-500 dark:text-zinc-400">
                    {{ $profile['role'] }} · {{ $profile['location'] }}
                </figcaption>
            </figure>

            {{-- Bio + stats --}}
            <div class="lg:col-span-3">
                <div class="reveal space-y-5 text-base leading-relaxed text-zinc-600 dark:text-zinc-400 sm:text-lg">
                    @foreach ($profile['bio'] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                    <p>
                        Feel free to reach out — I&rsquo;m always open to
                        <a href="#contact" class="font-medium text-indigo-600 underline-offset-4 transition hover:underline dark:text-indigo-400">new opportunities</a>,
                        collaborations and interesting conversations.
                    </p>
                </div>

                {{-- Quick stats --}}
                <div class="reveal mt-10 grid grid-cols-1 gap-4 sm:grid-cols-3" style="transition-delay: 120ms">
                    @foreach ($stats as $stat)
                        <div class="card px-6 py-7 text-center hover:-translate-y-1 hover:border-indigo-500/40 hover:shadow-md dark:hover:border-indigo-400/40">
                            <p class="font-display text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $stat['value'] }}</p>
                            <p class="mt-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="reveal mt-8 flex flex-wrap gap-4" style="transition-delay: 200ms">
                    <a href="#contact" class="btn btn-primary">Contact me</a>
                    <a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                        <x-icon name="github" class="h-4 w-4" />
                        GitHub profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
