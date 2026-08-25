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
     * Resume viewer — displays the PDF with Download + Print toolbar.
     */
    public function resume()
    {
        return view('resume', $this->sharedContent());
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
            'headline' => 'Building practical software solutions from the ground up. ',
            'bio_short' => 'Passionate IT student focused on developing database management tools and backend systems that streamline real-world operations.',
            'bio' => [
                'I am an enthusiastic student developer passionate about leveraging technology to improve daily workflows and operational efficiency. Through hands-on project creation and continuous practice, I aim to design reliable software solutions that are both intuitive and effective.',
                'My goal is to bridge software functionality with real-world user needs, whether through database management or interactive web platforms. As a fast learner seeking an internship or collaborative project team, I bring a strong problem-solving mindset and a drive to contribute value from day one. Feel free to connect, I am eager to explore internship roles, open-source projects, and technical discussions.',
            ],
            'email' => 'xyradelcastillo@gmail.com',
            'phone' => '+63 955 827 0251', // set to null to hide it
            'location' => 'Zone 1, Linasin Bangued Abra',
            'availability' => '', // set a value like 'Available for freelance work' to show the green badge
            'github' => 'https://github.com/xyradelcastillo',
            'linkedin' => '', // no LinkedIn yet — paste your profile URL here when you have one
            'socials' => [
                ['icon' => 'facebook', 'label' => 'Facebook', 'url' => 'https://www.facebook.com/agaznog.delcastillo'],
                ['icon' => 'instagram', 'label' => 'Instagram', 'url' => 'https://www.instagram.com/kakashiiyashori_'],
                ['icon' => 'tiktok', 'label' => 'TikTok', 'url' => 'https://www.tiktok.com/@dee_matchaaa'],
                ['icon' => 'telegram', 'label' => 'Telegram', 'url' => 'https://t.me/+639558270251'],
                ['icon' => 'discord', 'label' => 'Discord', 'url' => 'https://discord.com/users/1449760710807785567'],
            ],
            'resume' => route('resume'),
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
            ['value' => '4+', 'label' => 'Academic awards'],
            ['value' => '3+', 'label' => 'Programming languages'],
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
                'degree' => 'Bachelor of Information Technology',
                'field' => 'Tertiary · 4th Year',
                'period' => '2023 — Present',
                'description' => 'Brgy. Ubbog-Lipcan, Bangued, Abra.',
            ],
            [
                'institution' => 'Abra High School',
                'degree' => 'Secondary Education',
                'field' => 'General Academic Strand (GAS) · Senior High School',
                'period' => '2017 — 2023',
                'description' => 'Zone 3, Bangued, Abra.',
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
                'title' => 'Data Analytics and Visualization Essentials ',
                'issuer' => 'Department of Information and Communications Technology (DICT)',
                'icon' => 'award',
                'period' => '2023',
                'description' => '',
            ],
              [
                'title' => 'Online Safety Through Netiquette',
                'issuer' => 'Department of Information and Communications Technology (DICT)',
                'icon' => 'award',
                'period' => '2023',
                'description' => '',
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
                'title' => 'Java Enrollment System',
                'slug' => 'java-enrollment-system',
                'description' => 'A system for IT/CS students that collects student details, displays the correct curriculum, and computes tuition with discounts. It handles down payments and prints a full enrollment summary with balance.',
                'image' => asset('images/projects/itcs-enrollment.jpg'), // omit this key to get an auto-generated placeholder tile
                'github' => '#',
                'demo' => '#', // live demo URL, or '#'
                'tags' => [],
                'category' => '',
            ],
            [
                'title' => 'Student Management System (Python)',
                'slug' => 'student-management-python',
                'description' => 'A Python program that manages student records via a dictionary, supporting add, view, edit, delete and search by ID or name. It runs in an interactive loop until the user exits.',
                'image' => asset('images/projects/student-management-python.png'),
                'github' => '#',
                'demo' => '#',
                'tags' => [],
                'category' => '',
            ],
            [
                'title' => 'Student Management System (C#)',
                'slug' => 'student-management-csharp',
                'description' => 'A Visual Studio C# application for efficiently managing student information such as names, courses and year levels, with add, view, edit, delete and search functions for organizing academic data.',
                'image' => asset('images/projects/student-management-csharp.png'),
                'github' => '#',
                'demo' => '#',
                'tags' => [],
                'category' => '',
            ],
            [
                'title' => 'Student & Teacher Management System (C++)',
                'slug' => 'student-teacher-management-cpp',
                'description' => 'A menu-driven C++ program for managing student and teacher records using arrays. It supports add, view, edit, delete and search, with easy navigation between modules.',
                'image' => asset('images/projects/student-teacher-management-cpp.png'),
                'github' => '#',
                'demo' => '#',
                'tags' => [],
                'category' => '',
            ],
            [
                'title' => 'Personal Portfolio Website',
                'slug' => 'personal-portfolio-website',
                'description' => 'A responsive portfolio site built with modern web tech, featuring dark/light mode and smooth animations. It includes a photo gallery slider and a mobile-first design.',
                'image' => asset('images/projects/e_port.png'),
                'github' => '#',
                'demo' => '#',
                'tags' => [],
                'category' => 'school',
            ],
            [
                'title' => 'Database Management System (MS Access)',
                'slug' => 'database-management-ms-access',
                'description' => 'An MS Access database that organizes, stores and manages student and teacher information using structured tables, queries, forms and reports — simplifying academic record management for schools.',
                'image' => asset('images/projects/database-management.png'),
                'github' => '#',
                'demo' => '#',
                'tags' => [],
                'category' => '',
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
            'school' => '',
            'web' => 'Web',
            'database' => 'Databases',
        ];
    }
}
