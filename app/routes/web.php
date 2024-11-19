<?php
function routeForAdmin()
{
  
}

function routeForUser()
{
  Route::get('/admin', 'Admin/HomeController@index');
}

function routeForGuest()
{
  // Static route
  Route::get('/', 'HomeController@index');
  Route::get('/logout', 'AuthController@logout');
  Route::get('/about', 'PageController@about');
  Route::post('/contact', 'ContactController@submit');
  Route::get('/404', 'ErrorController@notFoundPage');

  // Dynamic route
  Route::get('/admin/user', 'UserController@index');


  // Auth
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



