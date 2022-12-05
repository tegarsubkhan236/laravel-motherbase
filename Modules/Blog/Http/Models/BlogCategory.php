<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Blog\Http\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class BlogCategory
 *
 * @property int $id
 * @property int|null $parentId
 * @property string $title
 * @property string|null $metaTitle
 * @property string $slug
 * @property string|null $content
 *
 * @property BlogCategory|null $parent
 * @property Collection|BlogCategory[] $children
 * @property Collection|BlogPostCategory[] $blog_post_categories
 *
 * @package Modules\Blog\Http\Models
 */
class BlogCategory extends Model
{
    use HasSlug;

	protected $table = 'blog_category';
	public $timestamps = false;

	protected $casts = [
		'parentId' => 'int'
	];

	protected $fillable = [
		'parentId',
		'title',
		'metaTitle',
		'slug',
		'content'
	];

    protected $hidden = [
        'pivot'
    ];

	public function parent(): BelongsTo
    {
		return $this->belongsTo(BlogCategory::class, 'parentId');
	}

	public function children(): HasMany
    {
		return $this->hasMany(BlogCategory::class, 'parentId');
	}

	public function blog_post_categories()
    {
		return $this->belongsToMany(BlogPost::class, 'blog_post_category', 'categoryId','postId' );
	}

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
