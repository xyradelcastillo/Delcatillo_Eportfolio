{{-- EDUCATION & CERTIFICATES: education timeline on the left, certificate cards on the right. --}}
<section id="education" class="section bg-zinc-50 dark:bg-zinc-900/40">
    <div class="container-site">
        <x-section-heading eyebrow="My journey" title="Education & Certificates" />

        <div class="mt-16 grid items-start gap-12 lg:grid-cols-2 lg:gap-10">
            {{-- Left column: education timeline --}}
            <div>
                <p class="eyebrow">Education</p>
                <ol class="relative ml-3 mt-8 max-w-2xl space-y-10 border-l border-zinc-200 pl-8 dark:border-zinc-800 sm:ml-6">
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

            {{-- Right column: certificates & achievements --}}
            <div>
                <p class="eyebrow">Certificates</p>
                <div class="mt-8 space-y-6">
                    @foreach ($certificates as $certificate)
                        <div class="reveal card flex items-start gap-5 p-6 hover:-translate-y-1 hover:shadow-md">
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400"
                                  aria-hidden="true">
                                <x-icon name="{{ $certificate['icon'] }}" class="h-6 w-6" />
                            </span>

                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-start justify-between gap-x-4 gap-y-2">
                                    <h3 class="font-display text-lg font-semibold text-zinc-900 dark:text-white">
                                        {{ $certificate['title'] }}
                                    </h3>
                                    <span class="chip shrink-0 font-semibold">{{ $certificate['period'] }}</span>
                                </div>

                                <p class="mt-1 flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ $certificate['issuer'] }}
                                </p>

                                @if (!empty($certificate['description']))
                                    <p class="mt-3 text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                                        {{ $certificate['description'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
