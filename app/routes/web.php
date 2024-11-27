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

  // Post CRUD
  Route::post('/post/request/add', 'PostController@addPost');
  Route::post('/post/request/edit/{id}', 'PostController@editPost');
  Route::post('/post/request/destroy/{id}', 'PostController@destroyPost');
  
  Route::get('/post/{postId}', 'PostController@getPostById');

  // Comment
  Route::post('/comment/request/add/{postId}', 'CommentController@addComment');

  // Asset
  Route::get('/assets/img/{fileName}', 'AssetController@getImage');
  Route::get('/assets/js/{fileName}', 'AssetController@getJs');
  Route::get('/assets/css/{fileName}', 'AssetController@getCss');

  Route::get('/assets/uploads/{fileName}', 'AssetController@getUpload');
  Route::get('/assets/img/{fileName}', 'AssetController@getUpload');
  Route::get('/assets/img/posts/{fileName}', 'AssetController@getUpload');
  Route::get('/assets/img/comments/{fileName}', 'AssetController@getUpload');
  Route::get('/assets/img/users/{fileName}', 'AssetController@getUpload');
  Route::get('/assets/img/events/{fileName}', 'AssetController@getUpload');
  Route::get('/assets/img/groups/{fileName}', 'AssetController@getUpload');
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



