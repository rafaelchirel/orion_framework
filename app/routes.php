<?php

$route[] = ['/','HomeController@index'];

$route[] = ['/posts','PostController@index'];
$route[] = ['/post/{id}/show','PostController@show'];
$route[] = ['/post/create','PostController@create', 'auth'];
$route[] = ['/post/store','PostController@store'];
$route[] = ['/post/{id}/edit','PostController@edit'];
$route[] = ['/post/{id}/update','PostController@update'];
$route[] = ['/post/{id}/delete','PostController@delete'];

$route[] = ['/user/create','UserController@create'];
$route[] = ['/user/store','UserController@store'];

$route[] = ['/login','UserController@login'];
$route[] = ['/login/auth','UserController@auth'];
$route[] = ['/logout','UserController@logout'];


return $route;