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
            'certificates' => $this->certificates(),
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
            'certificates' => $this->certificates(),
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
            'name' => 'Xyra G. Delcastillo',
            'initials' => 'Xyra G. Delcastillo',
            'role' => 'BS - Information Technology Student',
            'headline' => 'I turn curiosity into code, one project at a time.',
            'bio_short' => 'Motivated Computer Science student from Tayum, Abra, exploring web development while building small projects that sharpen my programming and problem-solving skills.',
            'bio' => [
                'I am a motivated beginner in Computer Science, deeply engaged in learning the core principles of programming and problem-solving. I am currently exploring web development and applying my growing skills by building small projects.',
                'As a passionate Computer Science student and aspiring web developer, my purpose is to create meaningful digital experiences that solve real-world problems and make technology accessible to everyone. I am a quick learner seeking an internship or collaborative environment where I can gain hands-on experience and support a development team.',
            ],
            'email' => 'xyradelcastillo@gmail.com',
            'phone' => '+63 918 467 600', // set to null to hide it
            'location' => 'Zone 1, Linasin Bangued Abra',
            'availability' => '', // set a value like 'Available for freelance work' to show the green badge
            'github' => '',
            'linkedin' => '', // no LinkedIn yet — paste your profile URL here when you have one
            'socials' => [
                ['icon' => 'facebook', 'label' => 'Facebook', 'url' => '#'],
                ['icon' => 'instagram', 'label' => 'Instagram', 'url' => '#'],
                ['icon' => 'tiktok', 'label' => 'TikTok', 'url' => '#'],
                ['icon' => 'telegram', 'label' => 'Telegram', 'url' => '#'],
                ['icon' => 'discord', 'label' => 'Discord', 'url' => '#'],
            ],
            'resume' => asset('files/Xyra-G.-Delcastillo-Resume.pdf'),
            'avatar' => asset('images/xyra.jpg'),
        ];
    }

    /**
     * Quick stats shown next to the About section.
     */
    private function stats(): array
    {
        return [
            // EDIT: your own numbers
            ['value' => '15+', 'label' => 'Years of learning'],
            ['value' => '9+', 'label' => 'Academic awards'],
            ['value' => '5+', 'label' => 'Programming languages'],
            ['value' => '4+', 'label' => 'Contests joined'],
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
                'institution' => 'Data Center College of the Philippines - Bangued',
                'degree' => 'Bachelor of Science in Computer Science',
                'field' => 'Tertiary · 4th Year',
                'period' => '2023 — Present',
                'description' => 'Brgy. Ubbog-Lipcan, Bangued, Abra.',
            ],
            [
                'institution' => 'Abra High School',
                'degree' => 'Secondary Education',
                'field' => 'TVL-ICT CSS NCII',
                'period' => '2017 — 2023',
                'description' => 'Brgy. An-anaao Budac, Tayum, Abra.',
            ],
            [
                'institution' => 'Velasco Elementary School',
                'degree' => 'Elementary Education',
                'field' => 'Primary',
                'period' => '2010 — 2017',
                'description' => 'Brgy. Velasco, Tayum, Abra.',
            ],
        ];
    }

    /**
     * Certificates & achievements rendered as cards next to the education
     * timeline (education on the left, certificates on the right).
     */
    private function certificates(): array
    {
        return [
            // EDIT: add / remove certificates freely.
            [
                'title' => 'Computer Systems Servicing NCII',
                'issuer' => 'TVL-ICT Strand · An-anaao Integrated School',
                'icon' => 'award',
                'period' => '2023',
                'description' => 'National Certificate II in Computer Systems Servicing earned under the senior high school TVL-ICT strand.',
            ],
            [
                'title' => 'Work Immersion — 80 Hours',
                'issuer' => 'Tayum Municipal Civil Registry · Municipality of Tayum',
                'icon' => 'briefcase',
                'period' => 'March 2023',
                'description' => 'Completed 80 hours of senior high school work immersion assisting at the municipal civil registry office.',
            ],
            [
                'title' => 'Sangguniang Kabataan Kagawad',
                'issuer' => 'Barangay Velasco, Tayum, Abra',
                'icon' => 'briefcase',
                'period' => '2023 — Present',
                'description' => 'Elected SK Kagawad — Chairman on Education and Culture; Committee on Peace and Environment.',
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
                'title' => 'ITCS Enrollment System',
                'slug' => 'itcs-enrollment-system',
                'description' => 'A comprehensive Java enrollment system for IT and CS students. It collects personal and academic details, displays the right curriculum per course/year/semester, computes tuition fees, applies academic discounts, processes down payments and prints a full enrollment summary with the student\'s balance.',
                'image' => asset('images/projects/itcs-enrollment.jpg'),
                'github' => '#',
                'demo' => '#', // live demo URL, or '#'
                'tags' => ['Java', 'Console App'],
                'category' => 'school',
            ],
            [
                'title' => 'Student Management System (Python)',
                'slug' => 'student-management-python',
                'description' => 'A Python program that manages student records using a dictionary. It supports adding, viewing, editing, deleting and searching students by ID or name, running in a loop until the user exits — an interactive way to organize student information.',
                'image' => asset('images/projects/student-management-python.png'),
                'github' => '#',
                'demo' => '#',
                'tags' => ['Python', 'CRUD'],
                'category' => 'school',
            ],
            [
                'title' => 'Student Management System (C#)',
                'slug' => 'student-management-csharp',
                'description' => 'A Visual Studio C# application for efficiently managing student information such as names, courses and year levels, with add, view, edit, delete and search functions for organizing academic data.',
                'image' => asset('images/projects/student-management-csharp.png'),
                'github' => '#',
                'demo' => '#',
                'tags' => ['C#', '.NET', 'Visual Studio'],
                'category' => 'school',
            ],
            [
                'title' => 'Student & Teacher Management System (C++)',
                'slug' => 'student-teacher-management-cpp',
                'description' => 'A menu-driven C++ program that handles basic record management for both students and teachers using arrays. Users can add, view, edit, delete and search records, navigating between student and teacher modules or exiting cleanly.',
                'image' => asset('images/projects/student-teacher-management-cpp.png'),
                'github' => '#',
                'demo' => '#',
                'tags' => ['C++', 'Record Management'],
                'category' => 'school',
            ],
            [
                'title' => 'Personal Portfolio Website',
                'slug' => 'personal-portfolio-website',
                'description' => 'Responsive portfolio website built with modern web technologies. Features dark/light mode, smooth animations, a photo gallery slider and a mobile-first design approach.',
                'image' => asset('images/projects/portfolio-website.png'),
                'github' => 'https://rucielmaeobias2105.github.io/',
                'demo' => 'https://rucielmaeobias2105.github.io/',
                'tags' => ['HTML', 'CSS', 'JavaScript'],
                'category' => 'web',
            ],
            [
                'title' => 'Database Management System (MS Access)',
                'slug' => 'database-management-ms-access',
                'description' => 'An MS Access database that organizes, stores and manages student and teacher information using structured tables, queries, forms and reports — simplifying academic record management for schools.',
                'image' => asset('images/projects/database-management.png'),
                'github' => '#',
                'demo' => '#',
                'tags' => ['MS Access', 'SQL'],
                'category' => 'database',
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
            'school' => 'School Projects',
            'web' => 'Web',
            'database' => 'Databases',
        ];
    }
}
