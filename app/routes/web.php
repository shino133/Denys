<?php
// ----------------------------------------------------------------
// Route public
// ----------------------------------------------------------------
Route::get('/', 'HomeController@index');
Route::get('/logout', 'AuthController@logout');
Route::get('/404', 'ErrorController@notFoundPage');
Route::get('/@{username}', 'UserController@profilePublicPage');

Route::get('/user/login', 'AuthController@login');
Route::get('/user/register', 'AuthController@register');
Route::get('/user/logout', 'AuthController@logout');

Route::post('/user/request/login', 'AuthController@loginRequest');
Route::post('/user/request/register', 'AuthController@registerRequest');


// ----------------------------------------------------------------
// Route private
// ----------------------------------------------------------------
if (Auth::checkUser()) {
  AppLoader::routeAccess('UserRoute');
}

// NOTE: Route Asset temporarily public 
AppLoader::routeAccess('AssetRoute');

// ----------------------------------------------------------------
// Route admin
// ----------------------------------------------------------------
if (Auth::checkAdmin()) {
  AppLoader::routeAccess('AdminRoute');
}



