<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\ContactRequest;
use App\Models\Portfolio\Project;
use App\Models\User;
use App\Services\Portfolio\PortfolioService;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }

    /**
     * Display the portfolio homepage.
     */
    public function index()
    {
        // Get the first admin user for demo purposes
        // In a real application, you might want to get a specific user or the logged-in user
        $user = User::first();
        
        if (!$user) {
            abort(404, 'Portfolio owner not found');
        }

        $profile = $this->portfolioService->getProfile($user);
        $skills = $this->portfolioService->getSkills($user);
        $featuredProjects = $this->portfolioService->getFeaturedProjects($user);
        $experiences = $this->portfolioService->getExperiences($user);
        $socialLinks = $this->portfolioService->getSocialLinks($user);

        return view('frontend.portfolio.index', compact(
            'user',
            'profile',
            'skills',
            'featuredProjects',
            'experiences',
            'socialLinks'
        ));
    }

    /**
     * Display the projects page.
     */
    public function projects()
    {
        $user = User::first();
        
        if (!$user) {
            abort(404, 'Portfolio owner not found');
        }

        $profile = $this->portfolioService->getProfile($user);
        $projects = $this->portfolioService->getProjects($user);
        $socialLinks = $this->portfolioService->getSocialLinks($user);

        return view('frontend.portfolio.projects', compact(
            'user',
            'profile',
            'projects',
            'socialLinks'
        ));
    }

    /**
     * Display a specific project.
     */
    public function project(Project $project)
    {
        $user = $project->user;
        $profile = $this->portfolioService->getProfile($user);
        $socialLinks = $this->portfolioService->getSocialLinks($user);

        return view('frontend.portfolio.project', compact(
            'user',
            'profile',
            'project',
            'socialLinks'
        ));
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        $user = User::first();
        
        if (!$user) {
            abort(404, 'Portfolio owner not found');
        }

        $profile = $this->portfolioService->getProfile($user);
        $socialLinks = $this->portfolioService->getSocialLinks($user);

        return view('frontend.portfolio.contact', compact(
            'user',
            'profile',
            'socialLinks'
        ));
    }

    /**
     * Submit a contact form.
     */
    public function submitContact(ContactRequest $request)
    {
        $user = User::first();
        
        if (!$user) {
            abort(404, 'Portfolio owner not found');
        }

        $this->portfolioService->saveContact($user, $request->validated());

        return redirect()->route('portfolio.contact')
            ->with('success', __('Your message has been sent successfully. We will get back to you soon!'));
    }

    /**
     * Display the CV page.
     */
    public function cv()
    {
        $user = User::first();
        
        if (!$user) {
            abort(404, 'Portfolio owner not found');
        }

        $profile = $this->portfolioService->getProfile($user);
        
        if (!$profile || !$profile->cv_path) {
            abort(404, 'CV not found');
        }

        return view('frontend.portfolio.cv', compact('profile'));
    }
}
