<?php

namespace App\Http\Controllers\Backend\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\ProfileRequest;
use App\Models\User;
use App\Services\Portfolio\PortfolioService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(private readonly PortfolioService $portfolioService)
    {
    }

    /**
     * Display the profile.
     */
    public function index()
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.view']);

        $user = User::first();
        $profile = $this->portfolioService->getProfile($user);

        return view('backend.portfolio.profile.index', compact('profile'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.edit']);
        $user = User::first();
        $profile = $this->portfolioService->getProfile($user);

        return view('backend.portfolio.profile.edit', compact('profile'));
    }

    /**
     * Update the profile.
     */
    public function update(ProfileRequest $request)
    {
        $this->checkAuthorization(Auth::user(), ['portfolio.edit']);
        $user = User::first();
        $profile = $this->portfolioService->saveProfile($user, $request->validated());

        return redirect()->route('admin.portfolio.profile.index')
            ->with('success', __('Profile updated successfully.'));
    }
}
