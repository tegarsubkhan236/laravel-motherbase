<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Blog\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogPostMetum
 *
 * @property int $id
 * @property int $postId
 * @property string $key
 * @property string|null $content
 *
 * @property BlogPost $blog_post
 *
 * @package Modules\Blog\Http\Models
 */
class BlogPostMeta extends Model
{
	protected $table = 'blog_post_meta';
	public $timestamps = false;

	protected $casts = [
		'postId' => 'int'
	];

	protected $fillable = [
		'postId',
		'key',
		'content'
	];

	public function blog_post()
	{
		return $this->belongsTo(BlogPost::class, 'postId');
	}
}
