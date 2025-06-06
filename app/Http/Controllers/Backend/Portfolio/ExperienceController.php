<?php

namespace App\Http\Controllers\Backend\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\ExperienceRequest;
use App\Models\Portfolio\Experience;
use App\Models\User;
use App\Services\Portfolio\PortfolioService;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function __construct(private readonly PortfolioService $portfolioService)
    {
    }

    /**
     * Display a listing of the experiences.
     */
    public function index()
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.view']);

        $user = User::first();
        $experiences = $this->portfolioService->getExperiences($user);

        return view('backend.portfolio.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new experience.
     */
    public function create()
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.create']);

        return view('backend.portfolio.experiences.create');
    }

    /**
     * Store a newly created experience.
     */
    public function store(ExperienceRequest $request)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.create']);

        $user = User::first();
        $this->portfolioService->saveExperience($user, $request->validated());

        return redirect()->route('admin.portfolio.experiences.index')
            ->with('success', __('Experience created successfully.'));
    }

    /**
     * Show the form for editing the experience.
     */
    public function edit(Experience $experience)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.edit']);
        return view('backend.portfolio.experiences.edit', compact('experience'));
    }

    /**
     * Update the experience.
     */
    public function update(ExperienceRequest $request, Experience $experience)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.edit']);

        $user = User::first();
        $data = $request->validated();
        $data['id'] = $experience->id;
        
        $this->portfolioService->saveExperience($user, $data);

        return redirect()->route('admin.portfolio.experiences.index')
            ->with('success', __('Experience updated successfully.'));
    }

    /**
     * Remove the experience.
     */
    public function destroy(Experience $experience)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.delete']);
        $this->portfolioService->deleteExperience($experience);

        return redirect()->route('admin.portfolio.experiences.index')
            ->with('success', __('Experience deleted successfully.'));
    }
}
