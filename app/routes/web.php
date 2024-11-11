<?php
function routeForAdmin()
{

}

function routeForUser()
{
}

function routeForGuest()
{
  // Static route
  Route::get('/', 'HomeController@index');
  Route::get('/logout', 'AuthController@logout');
  Route::get('/about', 'PageController@about');
  Route::post('/contact', 'ContactController@submit');
  
  // Dynamic route
  Route::get('/{username}', 'UserController@index');
  Route::get('/user/{nameAction}', 'AuthController@action');
  
  Route::post('/user/request/{nameAction}', 'AuthController@actionRequest');
}



// ----------------------------------------------------------------
routeForGuest();

if (Auth::checkUser()) {
  routeForUser();
}

if (Auth::checkAdmin()) {
  routeForAdmin();
}



