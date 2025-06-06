<?php

namespace App\Http\Controllers\Backend\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\SkillRequest;
use App\Models\Portfolio\Skill;
use App\Models\User;
use App\Services\Portfolio\PortfolioService;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function __construct(private readonly PortfolioService $portfolioService)
    {
    }

    /**
     * Display a listing of the skills.
     */
    public function index()
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.view']);

        $user = User::first();
        $skills = $this->portfolioService->getSkills($user);

        return view('backend.portfolio.skills.index', compact('skills'))
            ->with('breadcrumbs', [
                'title' => __('Skills'),
            ]);
    }

    /**
     * Show the form for creating a new skill.
     */
    public function create()
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.create']);

        return view('backend.portfolio.skills.create');
    }

    /**
     * Store a newly created skill.
     */
    public function store(SkillRequest $request)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.create']);

        $user = User::first();
        $this->portfolioService->saveSkill($user, $request->validated());

        return redirect()->route('admin.portfolio.skills.index')
            ->with('success', __('Skill created successfully.'));
    }

    /**
     * Show the form for editing the skill.
     */
    public function edit(Skill $skill)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.edit']);

        return view('backend.portfolio.skills.edit', compact('skill'));
    }

    /**
     * Update the skill.
     */
    public function update(SkillRequest $request, Skill $skill)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.edit']);

        $user = User::first();
        $data = $request->validated();
        $data['id'] = $skill->id;

        $this->portfolioService->saveSkill($user, $data);

        return redirect()->route('admin.portfolio.skills.index')
            ->with('success', __('Skill updated successfully.'));
    }

    /**
     * Remove the skill.
     */
    public function destroy(Skill $skill)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.delete']);

        $this->portfolioService->deleteSkill($skill);

        return redirect()->route('admin.portfolio.skills.index')
            ->with('success', __('Skill deleted successfully.'));
    }
}
