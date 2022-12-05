<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Blog\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogPostCategory
 * 
 * @property int $postId
 * @property int $categoryId
 * 
 * @property BlogCategory $blog_category
 * @property BlogPost $blog_post
 *
 * @package Modules\Blog\Http\Models
 */
class BlogPostCategory extends Model
{
	protected $table = 'blog_post_category';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'postId' => 'int',
		'categoryId' => 'int'
	];

	public function blog_category()
	{
		return $this->belongsTo(BlogCategory::class, 'categoryId');
	}

	public function blog_post()
	{
		return $this->belongsTo(BlogPost::class, 'postId');
	}
}
