<?php
namespace App\Models;

use Core\BaseModelEloquent;

class Post extends BaseModelEloquent
{
	public $table = "posts";

	public $timestamps = false;

	protected $fillable = ['title', 'content', 'user_id'];

	public function rules ()
	{
		return [
			'title'   => 'required|max:255',
			'content' => 'required'
		];
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function category()
	{
		return $this->belongsToMany(Category::class);
	}
}