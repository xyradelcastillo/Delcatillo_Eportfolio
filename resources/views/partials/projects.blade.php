{{-- PROJECTS: filterable responsive grid of project cards.
     Edit the underlying data in app/Http/Controllers/PortfolioController.php → projects(). --}}
<section id="projects" class="section">
    <div class="container-site">
        <div class="flex flex-col justify-between gap-8 md:flex-row md:items-end">
            <x-section-heading eyebrow="Selected work" title="Projects" />
            <p class="max-w-sm text-sm leading-relaxed text-zinc-500 dark:text-zinc-400">
             <!--   A collection of school and personal projects I&rsquo;ve built while learning
                different programming languages — from console apps to databases and the web. -->
            </p>
        </div>

      <!--  {{-- Category filters --}}
        <div class="reveal mt-10 flex flex-wrap gap-2" role="group" aria-label="Filter projects by category">
            @foreach ($projectFilters as $key => $label)
                <button type="button" data-filter="{{ $key }}" class="filter-btn"
                        aria-pressed="{{ $key === 'all' ? 'true' : 'false' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div> -->

        {{-- Cards --}}
        <div id="projects-grid" class="mt-10 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($projects as $index => $project)
                <article data-category="{{ $project['category'] }}"
                         class="project-card reveal card group flex flex-col overflow-hidden hover:-translate-y-1.5 hover:border-indigo-500/40 hover:shadow-lg dark:hover:border-indigo-400/40"
                         style="transition-delay: {{ min($index, 5) * 60 }}ms">
                    @if (isset($project['image']))
                        @if ($project['demo'] !== '#' || $project['github'] !== '#')
                            <a href="{{ $project['demo'] !== '#' ? $project['demo'] : $project['github'] }}"
                               target="_blank" rel="noopener noreferrer"
                               class="relative block aspect-[16/10] overflow-hidden bg-zinc-100 dark:bg-zinc-800"
                               tabindex="-1" aria-hidden="true">
                                <img src="{{ $project['image'] }}" alt="Screenshot of {{ $project['title'] }}" loading="lazy"
                                     width="1200" height="750"
                                     class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            </a>
                        @else
                            <div class="relative block aspect-[16/10] overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                                <img src="{{ $project['image'] }}" alt="Screenshot of {{ $project['title'] }}" loading="lazy"
                                     width="1200" height="750"
                                     class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            </div>
                        @endif
                    @else
                        {{-- No image provided — show auto-generated initials tile --}}
                        <div class="relative flex aspect-[16/10] items-center justify-center bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-700">
                            <span class="font-display text-3xl font-bold text-zinc-300 dark:text-zinc-500">
                                {{ strtoupper(collect(explode(' ', $project['title']))->take(2)->map(fn($w) => $w[0])->join('')) }}
                            </span>
                        </div>
                    @endif

                    <div class="flex flex-1 flex-col p-6">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="font-display text-lg font-semibold text-zinc-900 dark:text-white">
                                {{ $project['title'] }}
                            </h3>
                            @if ($project['github'] !== '#')
                                <a href="{{ $project['github'] }}" target="_blank" rel="noopener noreferrer"
                                   class="shrink-0 rounded-full p-1.5 text-zinc-400 transition hover:-translate-y-0.5 hover:text-indigo-600 dark:text-zinc-500 dark:hover:text-indigo-400"
                                   aria-label="View {{ $project['title'] }} on GitHub" title="GitHub repository"> 
                                    <x-icon name="github" class="h-5 w-5" />
                                </a>
                            @endif
                        </div>

                        <p class="mt-2 flex-1 text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                            {{ $project['description'] }}
                        </p>

                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($project['tags'] as $tag)
                                <span class="chip">{{ $tag }}</span>
                            @endforeach
                        </div>

                        <div class="mt-5 flex items-center justify-between border-t border-zinc-100 pt-4 dark:border-zinc-800">
                            @if ($project['demo'] !== '#' || $project['github'] !== '#')
                                <a href="{{ $project['demo'] !== '#' ? $project['demo'] : $project['github'] }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="group/link inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 transition-all hover:gap-2.5 dark:text-indigo-400">
                                    View project
                                    <x-icon name="arrow-up-right" class="h-4 w-4" />
                                </a>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-sm text-zinc-400 dark:text-zinc-500">
                                  <!--  Classroom project — no public link -->
                                </span>
                            @endif
                            <span class="text-xs font-medium uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                                {{ $projectFilters[$project['category']] ?? '' }}
                            </span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <p id="projects-empty" class="hidden py-16 text-center text-sm text-zinc-500 dark:text-zinc-400">
            No projects in this category yet.
        </p>
    </div>
</section>
