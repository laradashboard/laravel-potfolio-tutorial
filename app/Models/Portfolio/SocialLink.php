<?php

namespace App\Models\Portfolio;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialLink extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'portfolio_social_links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'platform',
        'url',
        'icon',
        'order',
    ];

    /**
     * Get the user that owns the social link.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the icon URL if exists.
     */
    public function getIconUrlAttribute(): ?string
    {
        return $this->icon ? asset('storage/' . $this->icon) : null;
    }

    /**
     * Get available social platforms.
     */
    public static function getAvailablePlatforms(): array
    {
        return [
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'linkedin' => 'LinkedIn',
            'github' => 'GitHub',
            'instagram' => 'Instagram',
            'youtube' => 'YouTube',
            'dribbble' => 'Dribbble',
            'behance' => 'Behance',
            'medium' => 'Medium',
            'stackoverflow' => 'Stack Overflow',
            'other' => 'Other',
        ];
    }
}
