<?php
namespace Core;

class Container 
{
	public static function newController($contoller)
    {
        $objContoller = "App\\Controllers\\" . $contoller;
        return new $objContoller;
    }

    public static function getModel($model){
        $objModel = "\\App\\Models\\" . $model;
        return new $objModel(DataBase::getDataBase());
    }

    public static function pageNotFound() {
    	$path = __DIR__ . "/../app/Views/404.phtml";
    	if ( file_exists($path) ) {
    		require_once $path;
    	} else {
    		echo 'Error 404: Page Not Found';
    	}
    }
}