<?php
namespace App\Models;

use Core\BaseModelEloquent;

class User extends BaseModelEloquent
{
	public $table = "users";

	public $timestamps = false;

	protected $fillable = ['name', 'email', 'password'];

	public function rulesAuth()
	{
		return [
			'email'    => 'email|required',
			'password' => 'min:6|max:16|required'
		];
	}

	public function rulesCreate ()
	{
		return [
			'name'     => 'min:4|max:255|required',
			'email'    => 'email|unique:user:email|required',
			'password' => 'min:6|max:16|required'
		];
	}

	public function rulesUpdate ($id)
	{
		return [
			'name'     => 'min:4|max:255',
			'email'    => "email|unique:user:email:$id",
			'password' => 'min:6|max:16'
		];
	}

	public function post()
	{
		return $this->hasMany(Post::class);
	}
}