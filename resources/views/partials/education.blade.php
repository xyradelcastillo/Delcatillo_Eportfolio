{{-- EDUCATION: vertical timeline of degrees & certifications. --}}
<section id="education" class="section bg-zinc-50 dark:bg-zinc-900/40">
    <div class="container-site">
        <x-section-heading eyebrow="My journey" title="Education & Certifications" />

        <ol class="relative ml-3 mt-16 max-w-3xl space-y-10 border-l border-zinc-200 pl-8 dark:border-zinc-800 sm:ml-6">
            @foreach ($education as $entry)
                <li class="reveal relative">
                    {{-- Timeline dot --}}
                    <span class="absolute -left-[41px] top-1.5 flex h-4 w-4 items-center justify-center rounded-full border-2 border-indigo-500 bg-white dark:border-indigo-400 dark:bg-zinc-950"
                          aria-hidden="true"></span>

                    <div class="card p-6 hover:-translate-y-1 hover:shadow-md sm:p-7">
                        <div class="flex flex-wrap items-start justify-between gap-x-4 gap-y-2">
                            <div>
                                <h3 class="font-display text-lg font-semibold text-zinc-900 dark:text-white">
                                    {{ $entry['degree'] }}
                                </h3>
                                <p class="mt-1 flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-zinc-500 dark:text-zinc-400">
                                    <x-icon name="graduation-cap" class="h-4 w-4 text-indigo-600 dark:text-indigo-400" />
                                    {{ $entry['institution'] }}
                                    <span class="text-zinc-300 dark:text-zinc-700" aria-hidden="true">·</span>
                                    {{ $entry['field'] }}
                                </p>
                            </div>
                            <span class="chip shrink-0 font-semibold">{{ $entry['period'] }}</span>
                        </div>

                        @if (!empty($entry['description']))
                            <p class="mt-3 text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                                {{ $entry['description'] }}
                            </p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>
