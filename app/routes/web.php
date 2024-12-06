<?php
function setCRUDRoute($url, $controller, $actionList = [])
{
  if (empty($actionList)) {
    Route::get("{$url}", "{$controller}@index");
    Route::get("{$url}/{id}", "{$controller}@getData");
    Route::get("{$url}/{id}/edit", "{$controller}@editPage");
    Route::post("{$url}/{id}/edit/request", "{$controller}@editData");
    Route::get("{$url}/add", "{$controller}@addPage");
    Route::post("{$url}/add/request", "{$controller}@addData");
    Route::get("{$url}/{id}/destroy/request", "{$controller}@destroyData");
    return;
  }

  $ac = [
    'index' => Route::get($url, $controller . '@' . $actionList['index']),
    'getData' => Route::get($url . '/{id}', $controller . '@' . $actionList['getData']),
    'editPage' => Route::get($url . '/{id}/edit', $controller . '@' . $actionList['editPage']),
    'editData' => Route::post($url . '/{id}/edit/request', $controller . '@' . $actionList['editData']),
    'addPage' => Route::get($url . '/add', $controller . '@' . $actionList['addPage']),
    'addData' => Route::post($url . '/add/request', $controller . '@' . $actionList['addData']),
    'destroyData' => Route::post($url . '/{id}/destroy/request', $controller . '@' . $actionList['destroyData']),
  ];

  foreach ($actionList as $key => $value) {
    if (isset($ac[$key])) {
      $ac[$key];
    }
  }
}


function routeForAdmin()
{
  Route::get('/admin', 'Admin/HomeAdminController@index');
  Route::get('/admin/manager', 'Admin/HomeAdminController@index');
  Route::get('/admin/dashboard', 'Admin/HomeAdminController@dashboard');

  // Route::get('/admin/user/settings', 'Admin/HomeAdminController@index');
  Route::get('/admin/manager/user/search', 'Admin/UserAdminController@searchData');

  Route::get("/admin/team-manager", "Admin/TeamManagerAdminController@index");

  $routerCRUD = [
    'user' => [
      'url' => '/admin/manager/user',
      'controller' => 'Admin/UserAdminController',
    ],
    'post' => [
      'url' => '/admin/manager/post',
      'controller' => 'Admin/PostAdminController',
    ],
    'group' => [
      'url' => '/admin/manager/group',
      'controller' => 'Admin/GroupAdminController',
    ],
    'event' => [
      'url' => '/admin/manager/event',
      'controller' => 'Admin/EventAdminController',
    ],
    'comment' => [
      'url' => '/admin/manager/comment',
      'controller' => 'Admin/CommentAdminController',
    ],
  ];

  foreach ($routerCRUD as $key => $value) {
    setCRUDRoute($value['url'], $value['controller']);
  }
}

function routeForUser()
{
  Route::get('/about', 'PageController@about');
  Route::post('/contact', 'ContactController@submit');

  Route::get('/user/settings', 'SettingController@index');
  Route::get('/user/settings/account', 'SettingController@accountPage');
  Route::get('/user/settings/contact', 'SettingController@contactPage');
  Route::get('/user/settings/password', 'SettingController@passwordPage');


  Route::post('/user/settings/account/request', 'SettingController@accountPageRequest');
  Route::post('/user/settings/contact/request', 'SettingController@contactPageRequest');
  Route::post('/user/settings/password/request', 'SettingController@passwordPageRequest');

  // User
  Route::get('/user/profile', 'UserController@profilePage');
  Route::post('/user/profile/avatar/upload/request', 'UserController@uploadAvatar');
  Route::post('/user/profile/banner/upload/request', 'UserController@uploadBanner');


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



