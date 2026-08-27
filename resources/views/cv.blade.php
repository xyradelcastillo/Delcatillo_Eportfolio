{{--
    Standalone, print-optimized CV.
    - /cv          → view in browser (has Print & Download buttons)
    - /cv?print=1  → opens the print dialog automatically
    - /cv/download → generated PDF download
    Content comes from the same arrays as the portfolio
    (app/Http/Controllers/PortfolioController.php).
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV | {{ $profile['name'] }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/x_logo.png') }}">
    <style>
        :root { --accent: #4f46e5; --ink: #18181b; --muted: #52525b; --line: #e4e4e7; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: #f4f4f5; color: var(--ink); line-height: 1.55; padding: 24px 16px 48px;
        }
        .sheet { max-width: 800px; margin: 0 auto; background: #fff; border-radius: 12px;
                 box-shadow: 0 10px 40px -12px rgb(0 0 0 / .15); padding: 56px 60px; }
        h1 { font-size: 30px; letter-spacing: -.02em; }
        .role { color: var(--accent); font-weight: 700; text-transform: uppercase;
                letter-spacing: .08em; font-size: 13px; margin-top: 2px; }
        .contact { color: var(--muted); font-size: 13px; margin-top: 10px; }
        .contact span + span::before { content: "\00B7"; margin: 0 8px; color: var(--line); }
        a { color: inherit; }
        section { margin-top: 28px; }
        h2 { font-size: 12px; text-transform: uppercase; letter-spacing: .14em;
             color: var(--accent); border-bottom: 2px solid var(--accent);
             padding-bottom: 6px; margin-bottom: 14px; }
        h3 { font-size: 14.5px; }
        .entry + .entry { margin-top: 16px; }
        .meta { color: var(--muted); font-size: 12.5px; font-style: italic; margin-top: 1px; }
        .desc { font-size: 13px; margin-top: 3px; color: #3f3f46; }
        p.body { font-size: 13px; color: #3f3f46; margin-top: 8px; }
        p.body + p.body { margin-top: 6px; }
        .stats { display: flex; gap: 24px; margin-top: 8px; }
        .stats div b { display: block; font-size: 18px; color: var(--accent); }
        .stats div small { color: var(--muted); }
        footer { margin-top: 36px; border-top: 1px solid var(--line); padding-top: 10px;
                 color: var(--muted); font-size: 11.5px; }

        /* Toolbar (screen only) */
        .toolbar { max-width: 800px; margin: 0 auto 14px; display: flex; gap: 8px; justify-content: flex-end; }
        .toolbar a, .toolbar button {
            appearance: none; cursor: pointer; font: inherit; font-size: 13px; font-weight: 600;
            padding: 8px 16px; border-radius: 999px; border: 1px solid var(--line);
            background: #fff; color: var(--ink); text-decoration: none; transition: all .15s ease;
        }
        .toolbar a:hover, .toolbar button:hover { border-color: var(--accent); color: var(--accent); }
        .toolbar .primary { background: var(--accent); border-color: var(--accent); color: #fff; }
        .toolbar .primary:hover { filter: brightness(1.1); color: #fff; }

        @media print {
            body { background: #fff; padding: 0; }
            .sheet { box-shadow: none; border-radius: 0; padding: 0; max-width: none; }
            .no-print { display: none !important; }
            @page { margin: 18mm 16mm; }
            section { break-inside: avoid-page; }
        }
    </style>
</head>
<body>
    <div class="toolbar no-print">
        <a href="{{ url('/') }}">&larr; Portfolio</a>
        <button type="button" onclick="window.print()">Print</button>
        <a class="primary" href="{{ route('cv.download') }}">Download PDF</a>
    </div>

    <div class="sheet">
        <header>
            <h1>{{ $profile['name'] }}</h1>
            <p class="role">{{ $profile['role'] }}</p>
            <p class="contact">
                <span><a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $profile['email'] }}">{{ $profile['email'] }}</a></span>
                @if (!empty($profile['phone']))<span>{{ $profile['phone'] }}</span>@endif
                <span>{{ $profile['location'] }}</span>
                <span><a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer">{{ str_replace(['https://', 'http://'], '', $profile['github']) }}</a></span>
                @if (!empty($profile['linkedin']))<span><a href="{{ $profile['linkedin'] }}" target="_blank" rel="noopener noreferrer">{{ str_replace(['https://', 'http://'], '', $profile['linkedin']) }}</a></span>@endif
            </p>
        </header>

        <section>
            <h2>Profile</h2>
            @foreach ($profile['bio'] as $paragraph)
                <p class="body">{{ $paragraph }}</p>
            @endforeach
            <div class="stats">
                @foreach ($stats as $stat)
                    <div><b>{{ $stat['value'] }}</b><small>{{ $stat['label'] }}</small></div>
                @endforeach
            </div>
        </section>

        <section>
            <h2>Education</h2>
            @foreach ($education as $entry)
                <div class="entry">
                    <h3>{{ $entry['degree'] }}</h3>
                    <p class="meta">{{ $entry['institution'] }} &middot; {{ $entry['field'] }} &middot; {{ $entry['period'] }}</p>
                    @if (!empty($entry['description']))
                        <p class="desc">{{ $entry['description'] }}</p>
                    @endif
                </div>
            @endforeach
        </section>

        <section>
            <h2>Certificates &amp; Achievements</h2>
            @foreach ($certificates as $certificate)
                <div class="entry">
                    <h3>{{ $certificate['title'] }}</h3>
                    <p class="meta">{{ $certificate['issuer'] }} &middot; {{ $certificate['period'] }}</p>
                    @if (!empty($certificate['description']))
                        <p class="desc">{{ $certificate['description'] }}</p>
                    @endif
                </div>
            @endforeach
        </section>

        <section>
            <h2>Selected Projects</h2>
            @foreach ($projects as $project)
                <div class="entry">
                    <h3>{{ $project['title'] }}
                        @if ($project['github'] !== '#')
                            <span style="font-weight:400;color:#71717a">&nbsp;&mdash;&nbsp;<a href="{{ $project['github'] }}" target="_blank" rel="noopener noreferrer">{{ str_replace(['https://', 'http://'], '', $project['github']) }}</a></span>
                        @endif
                    </h3>
                    <p class="meta">{{ implode(', ', $project['tags']) }}</p>
                    <p class="desc">{{ $project['description'] }}</p>
                </div>
            @endforeach
        </section>

        <footer>
            Generated {{ $generated }} &middot; {{ url('/') }}
        </footer>
    </div>

    @if (request()->boolean('print'))
        <script>window.addEventListener('load', () => window.print());</script>
    @endif
</body>
</html>
