<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Blog\Http\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class BlogPost
 *
 * @property int $id
 * @property int $authorId
 * @property int|null $parentId
 * @property string $title
 * @property string|null $metaTitle
 * @property string $slug
 * @property string|null $summary
 * @property bool $published
 * @property Carbon $createdAt
 * @property Carbon|null $updatedAt
 * @property Carbon|null $publishedAt
 * @property string|null $content
 *
 * @property BlogPost|null $blog_post
 * @property User $user
 * @property Collection|BlogPost[] $blog_posts
 * @property Collection|BlogPostCategory[] $blog_post_categories
 * @property Collection|BlogPostComment[] $blog_post_comments
 * @property Collection|BlogPostMeta[] $blog_post_meta
 *
 * @package Modules\Blog\Http\Models
 */
class BlogPost extends Model
{
    use HasSlug;

	protected $table = 'blog_post';
	public $timestamps = false;

	protected $casts = [
		'authorId' => 'int',
		'parentId' => 'int',
		'published' => 'bool'
	];

	protected $dates = [
		'createdAt',
		'updatedAt',
		'publishedAt'
	];

	protected $fillable = [
		'authorId',
		'parentId',
		'title',
		'metaTitle',
		'slug',
		'summary',
		'published',
		'createdAt',
		'updatedAt',
		'publishedAt',
		'content'
	];

    protected $hidden = [
        'pivot'
    ];

	public function blog_post()
	{
		return $this->belongsTo(BlogPost::class, 'parentId');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'authorId');
	}

	public function blog_posts()
	{
		return $this->hasMany(BlogPost::class, 'parentId');
	}

	public function blog_post_categories(): BelongsToMany
    {
		return $this->belongsToMany(BlogCategory::class,'blog_post_category','postId', 'categoryId');
	}

	public function blog_post_comments()
	{
		return $this->hasMany(BlogPostComment::class, 'postId');
	}

	public function blog_post_meta()
	{
		return $this->hasMany(BlogPostMeta::class, 'postId');
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
