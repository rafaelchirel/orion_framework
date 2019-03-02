<?php
namespace App\Models;

use Core\BaseModelEloquent;

class Category extends BaseModelEloquent
{
	public $table = "categories";

	public $timestamps = false;

	protected $fillable = ['name', 'description'];

	public function post()
	{
		return $this->belengsToMany(Post::class);
	}
}