<?php
namespace App\Controllers;

use Core\BaseController;

class HomeController extends BaseController
{
	public function index(){
		self::setPageTitle('Home');
		self::renderView('home/index', 'layout');
	}
}