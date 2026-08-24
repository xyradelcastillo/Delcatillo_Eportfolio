<?php

namespace App\Http\Controllers;

use App\Support\CvPdf;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    /* ======================================================================
     |  EDIT YOUR PORTFOLIO CONTENT HERE
     |  Everything rendered on the site comes from the plain PHP arrays
     |  below — there is no database. Change the values, save, refresh.
     | ====================================================================== */

    /**
     * Render the single-page portfolio.
     */
    public function index()
    {
        return view('home', [
            'profile' => $this->profile(),
            'stats' => $this->stats(),
            'education' => $this->education(),
            'projects' => $this->projects(),
            'projectFilters' => $this->projectFilters(),
        ]);
    }

    /**
     * Standalone printable CV view (browser-friendly, print-optimized).
     * Append ?print=1 to auto-open the browser's print dialog.
     */
    public function cv()
    {
        return view('cv', $this->sharedContent());
    }

    /**
     * Generate and download the CV as a PDF (built from the same data,
     * no external PDF library required).
     */
    public function downloadCv()
    {
        $pdf = (new CvPdf())->generate($this->sharedContent());

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="'.Str::slug($this->profile()['name']).'-cv.pdf"');
    }

    /**
     * Content shared between the portfolio page and the CV views.
     */
    private function sharedContent(): array
    {
        return [
            'profile' => $this->profile(),
            'stats' => $this->stats(),
            'education' => $this->education(),
            'projects' => $this->projects(),
            'generated' => now()->format('F Y'),
        ];
    }

    /**
     * Basic information used in the hero, contact section and footer.
     */
    private function profile(): array
    {
        return [
            // EDIT: your personal details
            'name' => 'Alex Carter',
            'initials' => 'AC',
            'role' => 'Full-Stack Web Developer',
            'headline' => 'I build clean, fast & accessible web applications.',
            'bio_short' => 'Berlin-based developer focused on Laravel, Tailwind CSS and modern JavaScript. I turn complex requirements into simple, beautiful products.',
            'bio' => [
                'I am a full-stack web developer with a passion for building things that live on the internet. My focus is on writing clean, maintainable code and crafting interfaces that feel effortless to use.',
                'When I am not coding, you will find me contributing to open-source projects, mentoring junior developers, or exploring the latest in back-end architecture and performance.',
            ],
            'email' => 'hello@alexcarter.dev',
            'phone' => '+49 30 1234 5678', // set to null to hide it
            'location' => 'Berlin, Germany',
            'availability' => 'Available for freelance work',
            'github' => 'https://github.com/username',
            'linkedin' => 'https://www.linkedin.com/in/username',
            'avatar' => asset('images/profile.svg'),
        ];
    }

    /**
     * Quick stats shown next to the About section.
     */
    private function stats(): array
    {
        return [
            // EDIT: your own numbers
            ['value' => '5+', 'label' => 'Years of experience'],
            ['value' => '20+', 'label' => 'Projects completed'],
            ['value' => '3', 'label' => 'Certifications'],
        ];
    }

    /**
     * Educational background rendered as a vertical timeline.
     */
    private function education(): array
    {
        return [
            // EDIT: add / remove entries freely — newest first looks best.
            [
                'institution' => 'Technical University of Berlin',
                'degree' => 'M.Sc. Software Engineering',
                'field' => 'Distributed Systems',
                'period' => '2021 — 2024',
                'description' => 'Focus on scalable architectures, cloud deployment and software quality assurance.',
            ],
            [
                'institution' => 'Technical University of Berlin',
                'degree' => 'B.Sc. Computer Science',
                'field' => 'Web Technologies',
                'period' => '2017 — 2021',
                'description' => 'Foundations of computer science with an emphasis on human-computer interaction.',
            ],
            [
                'institution' => 'Laravel Certification Program',
                'degree' => 'Certified Laravel Developer',
                'field' => 'Professional certification',
                'period' => '2023',
                'description' => 'Advanced application structure, testing practices and package development.',
            ],
            [
                'institution' => 'AWS Training & Certification',
                'degree' => 'Cloud Practitioner',
                'field' => 'Professional certification',
                'period' => '2022',
                'description' => 'Core AWS services, security, architecture principles and pricing models.',
            ],
        ];
    }

    /**
     * Projects grid. Each card needs: title, description, image, github,
     * tags and a category key that matches one of $projectFilters below.
     */
    private function projects(): array
    {
        return [
            // EDIT: replace these placeholders with your real projects.
            [
                'title' => 'TaskFlow',
                'slug' => 'taskflow',
                'description' => 'A team task management app with real-time collaboration, kanban boards and granular role permissions.',
                'image' => asset('images/projects/taskflow.svg'),
                'github' => 'https://github.com/username/taskflow',
                'demo' => '#', // live demo URL, or '#'
                'tags' => ['Laravel', 'Livewire', 'MySQL'],
                'category' => 'apps',
            ],
            [
                'title' => 'ShopLite',
                'slug' => 'shoplite',
                'description' => 'A lightweight e-commerce storefront with cart, checkout flow and an admin dashboard for inventory.',
                'image' => asset('images/projects/shoplite.svg'),
                'github' => 'https://github.com/username/shoplite',
                'demo' => '#',
                'tags' => ['Vue 3', 'Pinia', 'Tailwind CSS'],
                'category' => 'apps',
            ],
            [
                'title' => 'DevBlog API',
                'slug' => 'devblog-api',
                'description' => 'A RESTful blogging API with token authentication, rate limiting and full OpenAPI documentation.',
                'image' => asset('images/projects/devblog-api.svg'),
                'github' => 'https://github.com/username/devblog-api',
                'demo' => '#',
                'tags' => ['PHP 8', 'Laravel', 'REST'],
                'category' => 'apis',
            ],
            [
                'title' => 'WeatherNow',
                'slug' => 'weathernow',
                'description' => 'A weather dashboard with animated forecasts, geolocation search and historical trend charts.',
                'image' => asset('images/projects/weathernow.svg'),
                'github' => 'https://github.com/username/weathernow',
                'demo' => '#',
                'tags' => ['JavaScript', 'Chart.js', 'OpenWeather API'],
                'category' => 'apps',
            ],
            [
                'title' => 'Snipr',
                'slug' => 'snipr',
                'description' => 'A command-line snippet manager that syncs reusable code blocks across machines via Git.',
                'image' => asset('images/projects/snipr.svg'),
                'github' => 'https://github.com/username/snipr',
                'demo' => '#',
                'tags' => ['Node.js', 'CLI', 'SQLite'],
                'category' => 'oss',
            ],
            [
                'title' => 'Portfolio Starter',
                'slug' => 'portfolio-starter',
                'description' => 'This very website: a single-page portfolio template built with Laravel Blade, Vite and Tailwind CSS.',
                'image' => asset('images/projects/portfolio-starter.svg'),
                'github' => 'https://github.com/username/portfolio-starter',
                'demo' => '#',
                'tags' => ['Blade', 'Tailwind CSS', 'Vite'],
                'category' => 'oss',
            ],
        ];
    }

    /**
     * Filter buttons for the projects section.
     * Keys must match the 'category' values used on projects above.
     */
    private function projectFilters(): array
    {
        return [
            'all' => 'All',
            'apps' => 'Web Apps',
            'apis' => 'APIs & Backends',
            'oss' => 'Open Source',
        ];
    }
}
