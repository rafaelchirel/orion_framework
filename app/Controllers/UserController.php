<?php
namespace App\Controllers;

use App\Models\User;
use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use Core\Authenticate;

class UserController extends BaseController
{
	use Authenticate;
	
	private $user;

	public function __construct()
	{
		parent::__construct();
		$this->user = new User();
	}

	public function create()
	{
		self::setPageTitle('New User');
		return self::renderView('user/create', 'layout');
	}

	public function store($request)
	{
		$data = [
			'name'     => $request->post->name,
			'email'    => $request->post->email,
			'password' => $request->post->password
		];

		if (Validator::make($data, $this->user->rulesCreate())) 
			return Redirect::route("/user/create"); 

		$data['password'] = password_hash($request->post->password, PASSWORD_BCRYPT);

		try {
			User::create($data);
			return Redirect::route("/", ['success' => ['Usuario Registrado Exitosamente.']]);
		} catch (\Exception $e) {
			return Redirect::route("/", ['errors' => [$e->getMessage()]]);
		}
	}
}