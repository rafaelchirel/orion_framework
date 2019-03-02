<?php
namespace App\Controllers;

use App\Models\Post;
use App\Models\Category;
use Core\BaseController;
use Core\Redirect;
use Core\Validator;
use Core\Auth;

class PostController extends BaseController
{
	private $post;

	public function __construct() 
	{
		parent::__construct();
		$this->post = new Post;
	}

	public function index() 
	{
		$this->view->posts = $this->post->orderBy('id','desc')->get();
		self::setPageTitle('Posts');
		return self::renderView('posts/index', 'layout');
	}

	public function show($id) 
	{
		$this->view->post = $this->post->find($id);
		self::setPageTitle($this->view->post->title);
		return self::renderView('posts/show', 'layout');
	}

	public function create() 
	{
		self::setPageTitle("new post");
		$this->view->categories = Category::all();
		return self::renderView('posts/create', 'layout');
	}

	public function store($request) 
	{
		$data = [
			'title'   => $request->post->title,
			'content' => $request->post->content,
			'user_id' => (int) Auth::id()
		];

		$validator = Validator::make($data,$this->post->rules());
		if ($validator) 
			return Redirect::route("/post/create"); 
		
		$post = $this->post->create($data);
		if ($post) {
			if (isset($request->post->category_id)) 
				$post->category()->attach($request->post->category_id);
			return Redirect::route("/posts", ['success' => ['Post Creado.']]);
		} else {
			return Redirect::route("/posts", ['errors' => ['El Post no se pudo Registrar.']]);
		}
	}

	public function edit($id)
	{
		$this->view->post = $this->post->find($id);
		$this->view->categories = Category::all();

		if (Auth::id() != $this->view->post->user_id) 
			return Redirect::route("/posts", ['errors' => ['El Post no pertenece a este Autor, no puede modificarlo.']]);

		self::setPageTitle("Edit Post - {$this->view->post->title}");
		return self::renderView('posts/edit', 'layout');
	}

	public function update ($id, $request)
	{
		$data = [
			'title'   => $request->post->title,
			'content' => $request->post->content
		];

		$validator = Validator::make($data,$this->post->rules());
		if ($validator) 
			return Redirect::route("/post/{$id}/edit"); 
		
		try {
			$post = Post::find($id);
			$post->update($data);
			if (isset($request->post->category_id)) {
				$post->category()->sync($request->post->category_id);
			} else {
				$post->category()->detach();
			}
			
			return Redirect::route("/posts", ['success' => ['Post Actualizado']]);
		} catch (\Exception $e) {
			return Redirect::route("/posts", ['errors' => [$e->getMessage()]]);
		}
	}

	public function delete ($id) 
	{
		try {
			$post = Post::find($id);

			if (Auth::id() != $post->user_id) 
				return Redirect::route("/posts", ['errors' => ['El Post no pertenece a este Autor, no puede eliminarlo.']]);
		
			$post->delete();
			return Redirect::route("/posts", ['errors' => ['Post Eliminado.']]);
		} catch (\Exception $e) {
			return Redirect::route("/posts", ['errors' => [$e->getMessage()]]);
		}
	}
}