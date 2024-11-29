<?php
function routeForAdmin()
{
  Route::get('/admin', 'Admin/HomeController@index');
  Route::get('/admin/dashboard', 'Admin/HomeController@dashboard');
  
  // User manager
  Route::get('/admin/manager/user', 'Admin/UserController@index');
  Route::get('/admin/manager/user/add', 'Admin/UserController@index');
  Route::get('/admin/manager/user/edit/{id}', 'Admin/UserController@index');

  Route::post('/admin/manager/user/request/add', 'Admin/UserController@index');
  Route::post('/admin/manager/user/request/edit/{id}', 'Admin/UserController@index');
  Route::post('/admin/manager/user/request/destroy/{id}', 'Admin/UserController@index');

  // Post manager
  Route::get('/admin/manager/post', 'Admin/PostController@index');
  Route::get('/admin/manager/post/add', 'Admin/PostController@index');
  Route::get('/admin/manager/post/edit/{id}', 'Admin/PostController@index');

  Route::post('/admin/manager/post/request/add', 'Admin/PostController@index');
  Route::post('/admin/manager/post/request/edit/{id}', 'Admin/PostController@index');
  Route::post('/admin/manager/post/request/destroy/{id}', 'Admin/PostController@index');

  // Group manager
  Route::get('/admin/manager/group', 'Admin/GroupController@index');
  Route::get('/admin/manager/group/get/{id}', 'Admin/GroupController@index');
  Route::get('/admin/manager/group/add', 'Admin/GroupController@index');
  Route::get('/admin/manager/group/edit/{id}', 'Admin/GroupController@index');

  Route::post('/admin/manager/group/request/add', 'Admin/GroupController@index');
  Route::post('/admin/manager/group/request/edit/{id}', 'Admin/GroupController@index');
  Route::post('/admin/manager/group/request/destroy/{id}', 'Admin/GroupController@index'); 

  //Event manager
  Route::get('/admin/manager/event', 'Admin/EventController@index');
  Route::get('/admin/manager/event/add', 'Admin/EventController@index');
  Route::get('/admin/manager/event/edit/{id}', 'Admin/EventController@index');

  Route::post('/admin/manager/event/request/add', 'Admin/EventController@index');
  Route::post('/admin/manager/event/request/edit/{id}', 'Admin/EventController@index');
  Route::post('/admin/manager/event/request/destroy/{id}', 'Admin/EventController@index');

  // Comment manager
  Route::get('/admin/manager/comment', 'Admin/CommentController@index');
  Route::get('/admin/manager/comment/add', 'Admin/CommentController@index');
  Route::get('/admin/manager/comment/edit/{id}', 'Admin/CommentController@index');

  Route::post('/admin/manager/comment/request/add', 'Admin/CommentController@index');
  Route::post('/admin/manager/comment/request/edit/{id}', 'Admin/CommentController@index');
  Route::post('/admin/manager/comment/request/destroy/{id}', 'Admin/CommentController@index');

  // Team manager
  Route::get('/admin/team-manager', 'Admin/TeamManagerController@index');
  Route::get('/admin/team-manager/add', 'Admin/TeamManagerController@addPage');
  Route::get('/admin/team-manager/edit/{id}', 'Admin/HomeController@index');

  Route::post('/admin/team-manager/request/add', 'Admin/HomeController@index');
  Route::post('/admin/team-manager/request/edit/{id}', 'Admin/HomeController@index');
  Route::post('/admin/team-manager/request/destroy/{id}', 'Admin/HomeController@index');

  Route::get('/admin/user/settings', 'Admin/HomeController@index');
}

function routeForUser()
{
  Route::get('/about', 'PageController@about');
  Route::post('/contact', 'ContactController@submit');

  // User
  Route::get('/user/profile', 'UserController@getProfile');


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



