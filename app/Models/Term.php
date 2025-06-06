<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasUniqueSlug;
use App\Traits\QueryBuilderTrait;
use Illuminate\Database\Eloquent\Builder;

class Term extends Model
{
    use HasFactory, QueryBuilderTrait, HasUniqueSlug;

    protected $fillable = [
        'name',
        'slug',
        'taxonomy',
        'description',
        'featured_image',
        'parent_id'
    ];

    protected function getSlugSourceField($model): string
    {
        return 'name';
    }

    /**
     * Boot method to auto-generate slug.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug($model);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug($model);
            }
        });
    }

    /**
     * Get the taxonomy that owns the term.
     */
    public function taxonomyModel(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class, 'taxonomy', 'name');
    }

    /**
     * Get the parent term.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Term::class, 'parent_id');
    }

    /**
     * Get the child terms.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Term::class, 'parent_id');
    }

    /**
     * The posts that belong to the term.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'term_relationships');
    }

    /**
     * Custom sort method for post_count (alias for posts_count)
     */
    public function sortByPostCount(Builder $query, string $direction = 'asc'): void
    {
        $query->withCount('posts')->orderBy('posts_count', $direction);
    }

    /**
     * Custom sort method for posts_count
     */
    public function sortByPostsCount(Builder $query, string $direction = 'asc'): void
    {
        $query->withCount('posts')->orderBy('posts_count', $direction);
    }

    /**
     * Get searchable columns for the model.
     *
     * @return array
     */
    protected function getSearchableColumns(): array
    {
        return ['name', 'slug', 'description'];
    }

    /**
     * Get columns that should be excluded from sorting.
     *
     * @return array
     */
    protected function getExcludedSortColumns(): array
    {
        return ['description'];
    }
}
