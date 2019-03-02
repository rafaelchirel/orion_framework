<?php
namespace Core;

abstract class BaseController 
{
	protected $view;
	protected $auth;
	protected $errors;
	protected $success;
	protected $inputs;
	private $viewPath;
	private $layoutPath;
	private $pageTitle = null;

	public function __construct(){
		$this->view = new \stdClass;
		$this->auth = new Auth;
		
		if (Session::get('errors')) {
			$this->errors = Session::get('errors');
			Session::destroy('errors');
		}

		if (Session::get('inputs')) {
			$this->inputs = Session::get('inputs');
			Session::destroy('inputs');
		}

		if (Session::get('success')) {
			$this->success = Session::get('success');
			Session::destroy('success');
		}
	}

	protected function renderView($viewPath, $layoutPath = null){
		$this->viewPath = $viewPath;
		
		if ($layoutPath) {
			$this->layoutPath = $layoutPath;
			return self::layout();
		} else {
			return self::content();
		}
	}

	protected function content(){
		$path = __DIR__ . "/../app/Views/{$this->viewPath}.phtml";

		if (file_exists($path)) {
			return require_once $path;
		} else {
			echo 'Error: View no encontrada';
		}
	}

	protected function layout(){
		$path = __DIR__ . "/../app/Views/{$this->layoutPath}.phtml";

		if (file_exists($path)) {
			return require_once $path;
		} else {
			echo 'Error: Layout no encontrada';
		}
	}

	protected function setPageTitle( $pageTitle ){
		$this->pageTitle = $pageTitle;
	}

	protected function getPageTitle( $separator = null ){
		if ($separator) {
			return "{$this->pageTitle} {$separator}";
		} else {
			return $this->pageTitle;
		}
	}

	public function forbiden()
	{
		return Redirect::route('/login');
	}
}