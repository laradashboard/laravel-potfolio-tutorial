<?php

namespace Database\Seeders;

use App\Models\Portfolio\Experience;
use App\Models\Portfolio\Profile;
use App\Models\Portfolio\Project;
use App\Models\Portfolio\Skill;
use App\Models\Portfolio\SocialLink;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin user
        $user = User::role('admin')->first();

        if (!$user) {
            return;
        }

        // Create profile
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '+1 (555) 123-4567',
                'bio' => 'Full-stack web developer with over 5 years of experience in building modern web applications using Laravel, Vue.js, and React. Passionate about clean code, performance optimization, and user experience.',
                'job_title' => 'Senior Full-Stack Developer',
                'location' => 'New York, USA',
            ]
        );

        // Create skills
        $skills = [
            [
                'name' => 'Laravel',
                'percentage' => 95,
                'order' => 1,
            ],
            [
                'name' => 'PHP',
                'percentage' => 90,
                'order' => 2,
            ],
            [
                'name' => 'JavaScript',
                'percentage' => 85,
                'order' => 3,
            ],
            [
                'name' => 'Vue.js',
                'percentage' => 80,
                'order' => 4,
            ],
            [
                'name' => 'React',
                'percentage' => 75,
                'order' => 5,
            ],
            [
                'name' => 'Tailwind CSS',
                'percentage' => 90,
                'order' => 6,
            ],
            [
                'name' => 'MySQL',
                'percentage' => 85,
                'order' => 7,
            ],
            [
                'name' => 'Docker',
                'percentage' => 70,
                'order' => 8,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'name' => $skill['name'],
                ],
                [
                    'percentage' => $skill['percentage'],
                    'order' => $skill['order'],
                ]
            );
        }

        // Create projects
        $projects = [
            [
                'name' => 'E-commerce Platform',
                'slug' => 'e-commerce-platform',
                'summary' => 'A full-featured e-commerce platform built with Laravel and Vue.js.',
                'description' => 'This e-commerce platform includes product management, cart functionality, checkout process, payment integration, order management, and user authentication. Built with Laravel for the backend API and Vue.js for the frontend.',
                'github_link' => 'https://github.com/johndoe/ecommerce-platform',
                'demo_link' => 'https://ecommerce-demo.example.com',
                'order' => 1,
                'featured' => true,
            ],
            [
                'name' => 'Task Management System',
                'slug' => 'task-management-system',
                'summary' => 'A task management system with real-time updates using Laravel, Livewire, and Alpine.js.',
                'description' => 'This task management system allows users to create, assign, and track tasks in real-time. It includes features like task categories, priorities, due dates, comments, and file attachments. Built with Laravel, Livewire, and Alpine.js.',
                'github_link' => 'https://github.com/johndoe/task-management',
                'demo_link' => 'https://tasks-demo.example.com',
                'order' => 2,
                'featured' => true,
            ],
            [
                'name' => 'Blog Platform',
                'slug' => 'blog-platform',
                'summary' => 'A modern blog platform with markdown support and SEO optimization.',
                'description' => 'This blog platform includes features like markdown editing, categories, tags, comments, and SEO optimization. Built with Laravel and Tailwind CSS.',
                'github_link' => 'https://github.com/johndoe/blog-platform',
                'demo_link' => 'https://blog-demo.example.com',
                'order' => 3,
                'featured' => true,
            ],
            [
                'name' => 'CRM System',
                'slug' => 'crm-system',
                'summary' => 'A customer relationship management system for small businesses.',
                'description' => 'This CRM system helps small businesses manage their customer relationships, track leads, and monitor sales activities. It includes features like contact management, lead tracking, task scheduling, and reporting. Built with Laravel and React.',
                'github_link' => 'https://github.com/johndoe/crm-system',
                'demo_link' => 'https://crm-demo.example.com',
                'order' => 4,
                'featured' => false,
            ],
            [
                'name' => 'Portfolio Website',
                'slug' => 'portfolio-website',
                'summary' => 'A personal portfolio website to showcase projects and skills.',
                'description' => 'This portfolio website showcases my projects, skills, and experience. It includes features like project filtering, contact form, and responsive design. Built with Laravel, Alpine.js, and Tailwind CSS.',
                'github_link' => 'https://github.com/johndoe/portfolio',
                'demo_link' => 'https://johndoe.example.com',
                'order' => 5,
                'featured' => false,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'slug' => $project['slug'],
                ],
                [
                    'name' => $project['name'],
                    'summary' => $project['summary'],
                    'description' => $project['description'],
                    'github_link' => $project['github_link'],
                    'demo_link' => $project['demo_link'],
                    'order' => $project['order'],
                    'featured' => $project['featured'],
                ]
            );
        }

        // Create experiences
        $experiences = [
            [
                'company_name' => 'Tech Innovators Inc.',
                'role' => 'Senior Full-Stack Developer',
                'start_year' => '2022',
                'current' => true,
                'summary' => 'Leading the development of enterprise web applications using Laravel, Vue.js, and React. Responsible for architecture design, code reviews, and mentoring junior developers.',
                'company_website' => 'https://techinnovators.example.com',
                'order' => 1,
            ],
            [
                'company_name' => 'Web Solutions Ltd.',
                'role' => 'Full-Stack Developer',
                'start_year' => '2019',
                'end_year' => '2022',
                'current' => false,
                'summary' => 'Developed and maintained multiple web applications for clients in various industries. Worked with Laravel, Vue.js, and MySQL.',
                'company_website' => 'https://websolutions.example.com',
                'order' => 2,
            ],
            [
                'company_name' => 'Digital Agency',
                'role' => 'Junior Developer',
                'start_year' => '2017',
                'end_year' => '2019',
                'current' => false,
                'summary' => 'Started as a junior developer working on frontend development with HTML, CSS, and JavaScript. Later transitioned to full-stack development with PHP and Laravel.',
                'company_website' => 'https://digitalagency.example.com',
                'order' => 3,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'company_name' => $experience['company_name'],
                    'role' => $experience['role'],
                ],
                [
                    'start_year' => $experience['start_year'],
                    'end_year' => $experience['end_year'] ?? null,
                    'current' => $experience['current'],
                    'summary' => $experience['summary'],
                    'company_website' => $experience['company_website'],
                    'order' => $experience['order'],
                ]
            );
        }

        // Create social links
        $socialLinks = [
            [
                'platform' => 'github',
                'url' => 'https://github.com/johndoe',
                'order' => 1,
            ],
            [
                'platform' => 'linkedin',
                'url' => 'https://linkedin.com/in/johndoe',
                'order' => 2,
            ],
            [
                'platform' => 'twitter',
                'url' => 'https://twitter.com/johndoe',
                'order' => 3,
            ],
            [
                'platform' => 'facebook',
                'url' => 'https://facebook.com/johndoe',
                'order' => 4,
            ],
        ];

        foreach ($socialLinks as $socialLink) {
            SocialLink::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'platform' => $socialLink['platform'],
                ],
                [
                    'url' => $socialLink['url'],
                    'order' => $socialLink['order'],
                ]
            );
        }
    }
}
