<?php

namespace App\Services\Portfolio;

use App\Models\Portfolio\Contact;
use App\Models\Portfolio\Experience;
use App\Models\Portfolio\Profile;
use App\Models\Portfolio\Project;
use App\Models\Portfolio\Skill;
use App\Models\Portfolio\SocialLink;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PortfolioService
{
    /**
     * Get the profile for a user.
     */
    public function getProfile(User $user): ?Profile
    {
        return Profile::where('user_id', $user->id)->first();
    }

    /**
     * Create or update a profile.
     */
    public function saveProfile(User $user, array $data): Profile
    {
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'bio' => $data['bio'] ?? null,
                'job_title' => $data['job_title'] ?? null,
                'location' => $data['location'] ?? null,
            ]
        );

        // Handle CV upload
        if (isset($data['cv']) && $data['cv'] instanceof UploadedFile) {
            $this->uploadCV($profile, $data['cv']);
        }

        // Handle profile image upload
        if (isset($data['profile_image']) && $data['profile_image'] instanceof UploadedFile) {
            $this->uploadProfileImage($profile, $data['profile_image']);
        }

        return $profile;
    }

    /**
     * Upload CV file.
     */
    public function uploadCV(Profile $profile, UploadedFile $file): Profile
    {
        // Delete old CV if exists
        if ($profile->cv_path) {
            Storage::disk('public')->delete($profile->cv_path);
        }

        // Store new CV
        $path = $file->store('portfolio/cv', 'public');
        $profile->update(['cv_path' => $path]);

        return $profile;
    }

    /**
     * Upload profile image.
     */
    public function uploadProfileImage(Profile $profile, UploadedFile $file): Profile
    {
        // Delete old image if exists
        if ($profile->profile_image) {
            Storage::disk('public')->delete($profile->profile_image);
        }

        // Store new image
        $path = $file->store('portfolio/profile', 'public');
        $profile->update(['profile_image' => $path]);

        return $profile;
    }

    /**
     * Get skills for a user.
     */
    public function getSkills(User $user)
    {
        return Skill::where('user_id', $user->id)
            ->orderBy('order')
            ->get();
    }

    /**
     * Save a skill.
     */
    public function saveSkill(User $user, array $data): Skill
    {
        $skill = Skill::updateOrCreate(
            [
                'id' => $data['id'] ?? null,
                'user_id' => $user->id,
            ],
            [
                'name' => $data['name'],
                'percentage' => $data['percentage'] ?? 0,
                'order' => $data['order'] ?? 0,
            ]
        );

        // Handle icon upload
        if (isset($data['icon']) && $data['icon'] instanceof UploadedFile) {
            $this->uploadSkillIcon($skill, $data['icon']);
        }

        return $skill;
    }

    /**
     * Upload skill icon.
     */
    public function uploadSkillIcon(Skill $skill, UploadedFile $file): Skill
    {
        // Delete old icon if exists
        if ($skill->icon) {
            Storage::disk('public')->delete($skill->icon);
        }

        // Store new icon
        $path = $file->store('portfolio/skills', 'public');
        $skill->update(['icon' => $path]);

        return $skill;
    }

    /**
     * Delete a skill.
     */
    public function deleteSkill(Skill $skill): bool
    {
        // Delete icon if exists
        if ($skill->icon) {
            Storage::disk('public')->delete($skill->icon);
        }

        return $skill->delete();
    }

    /**
     * Get projects for a user.
     */
    public function getProjects(User $user)
    {
        return Project::where('user_id', $user->id)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get featured projects for a user.
     */
    public function getFeaturedProjects(User $user)
    {
        return Project::where('user_id', $user->id)
            ->where('featured', true)
            ->orderBy('order')
            ->get();
    }

    /**
     * Save a project.
     */
    public function saveProject(User $user, array $data): Project
    {
        $project = Project::updateOrCreate(
            [
                'id' => $data['id'] ?? null,
                'user_id' => $user->id,
            ],
            [
                'name' => $data['name'],
                'slug' => $data['slug'] ?? null,
                'summary' => $data['summary'] ?? null,
                'description' => $data['description'] ?? null,
                'github_link' => $data['github_link'] ?? null,
                'demo_link' => $data['demo_link'] ?? null,
                'order' => $data['order'] ?? 0,
                'featured' => $data['featured'] ?? false,
            ]
        );

        // Handle image upload
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $this->uploadProjectImage($project, $data['image']);
        }

        return $project;
    }

    /**
     * Upload project image.
     */
    public function uploadProjectImage(Project $project, UploadedFile $file): Project
    {
        // Delete old image if exists
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        // Store new image
        $path = $file->store('portfolio/projects', 'public');
        $project->update(['image' => $path]);

        return $project;
    }

    /**
     * Delete a project.
     */
    public function deleteProject(Project $project): bool
    {
        // Delete image if exists
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        return $project->delete();
    }

    /**
     * Get experiences for a user.
     */
    public function getExperiences(User $user)
    {
        return Experience::where('user_id', $user->id)
            ->orderBy('order')
            ->get();
    }

    /**
     * Save an experience.
     */
    public function saveExperience(User $user, array $data): Experience
    {
        $experience = Experience::updateOrCreate(
            [
                'id' => $data['id'] ?? null,
                'user_id' => $user->id,
            ],
            [
                'company_name' => $data['company_name'],
                'role' => $data['role'],
                'start_year' => $data['start_year'],
                'end_year' => $data['end_year'] ?? null,
                'current' => $data['current'] ?? false,
                'summary' => $data['summary'] ?? null,
                'company_website' => $data['company_website'] ?? null,
                'order' => $data['order'] ?? 0,
            ]
        );

        // Handle company logo upload
        if (isset($data['company_logo']) && $data['company_logo'] instanceof UploadedFile) {
            $this->uploadCompanyLogo($experience, $data['company_logo']);
        }

        return $experience;
    }

    /**
     * Upload company logo.
     */
    public function uploadCompanyLogo(Experience $experience, UploadedFile $file): Experience
    {
        // Delete old logo if exists
        if ($experience->company_logo) {
            Storage::disk('public')->delete($experience->company_logo);
        }

        // Store new logo
        $path = $file->store('portfolio/companies', 'public');
        $experience->update(['company_logo' => $path]);

        return $experience;
    }

    /**
     * Delete an experience.
     */
    public function deleteExperience(Experience $experience): bool
    {
        // Delete logo if exists
        if ($experience->company_logo) {
            Storage::disk('public')->delete($experience->company_logo);
        }

        return $experience->delete();
    }

    /**
     * Get social links for a user.
     */
    public function getSocialLinks(User $user)
    {
        return SocialLink::where('user_id', $user->id)
            ->orderBy('order')
            ->get();
    }

    /**
     * Save a social link.
     */
    public function saveSocialLink(User $user, array $data): SocialLink
    {
        $socialLink = SocialLink::updateOrCreate(
            [
                'id' => $data['id'] ?? null,
                'user_id' => $user->id,
            ],
            [
                'platform' => $data['platform'],
                'url' => $data['url'],
                'order' => $data['order'] ?? 0,
            ]
        );

        // Handle icon upload
        if (isset($data['icon']) && $data['icon'] instanceof UploadedFile) {
            $this->uploadSocialIcon($socialLink, $data['icon']);
        }

        return $socialLink;
    }

    /**
     * Upload social icon.
     */
    public function uploadSocialIcon(SocialLink $socialLink, UploadedFile $file): SocialLink
    {
        // Delete old icon if exists
        if ($socialLink->icon) {
            Storage::disk('public')->delete($socialLink->icon);
        }

        // Store new icon
        $path = $file->store('portfolio/social', 'public');
        $socialLink->update(['icon' => $path]);

        return $socialLink;
    }

    /**
     * Delete a social link.
     */
    public function deleteSocialLink(SocialLink $socialLink): bool
    {
        // Delete icon if exists
        if ($socialLink->icon) {
            Storage::disk('public')->delete($socialLink->icon);
        }

        return $socialLink->delete();
    }

    /**
     * Get contacts for a user.
     */
    public function getContacts(User $user)
    {
        return Contact::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Save a contact.
     */
    public function saveContact(User $user, array $data): Contact
    {
        return Contact::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'],
        ]);
    }

    /**
     * Mark a contact as read.
     */
    public function markContactAsRead(Contact $contact): Contact
    {
        return $contact->markAsRead();
    }

    /**
     * Delete a contact.
     */
    public function deleteContact(Contact $contact): bool
    {
        return $contact->delete();
    }
}
