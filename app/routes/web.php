<?php
function routeForAdmin()
{
  Route::get('/admin', 'Admin/HomeController@index');
  Route::get('/admin/user', 'UserController@index');
}

function routeForUser()
{

  Route::get('/about', 'PageController@about');
  Route::post('/contact', 'ContactController@submit');
}

function routeForGuest()
{
  Route::get('/', 'HomeController@index');
  Route::get('/logout', 'AuthController@logout');
  Route::get('/404', 'ErrorController@notFoundPage');
  Route::get('/user/login', 'AuthController@login');
  Route::get('/user/register', 'AuthController@register');
  Route::get('/user/logout', 'AuthController@logout');
  Route::post('/user/request/login', 'AuthController@loginRequest');
  Route::post('/user/request/register', 'AuthController@registerRequest');
}



// ----------------------------------------------------------------
routeForGuest();

if (Auth::checkUser()) {
  routeForUser();
}

if (Auth::checkAdmin()) {
  routeForAdmin();
}



