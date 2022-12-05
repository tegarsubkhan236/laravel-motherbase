<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Blog\Http\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogPostComment
 * 
 * @property int $id
 * @property int $postId
 * @property int|null $parentId
 * @property string $title
 * @property bool $published
 * @property Carbon $createdAt
 * @property Carbon|null $publishedAt
 * @property string|null $content
 * 
 * @property BlogPostComment|null $blog_post_comment
 * @property BlogPost $blog_post
 * @property Collection|BlogPostComment[] $blog_post_comments
 *
 * @package Modules\Blog\Http\Models
 */
class BlogPostComment extends Model
{
	protected $table = 'blog_post_comment';
	public $timestamps = false;

	protected $casts = [
		'postId' => 'int',
		'parentId' => 'int',
		'published' => 'bool'
	];

	protected $dates = [
		'createdAt',
		'publishedAt'
	];

	protected $fillable = [
		'postId',
		'parentId',
		'title',
		'published',
		'createdAt',
		'publishedAt',
		'content'
	];

	public function blog_post_comment()
	{
		return $this->belongsTo(BlogPostComment::class, 'parentId');
	}

	public function blog_post()
	{
		return $this->belongsTo(BlogPost::class, 'postId');
	}

	public function blog_post_comments()
	{
		return $this->hasMany(BlogPostComment::class, 'parentId');
	}
}
