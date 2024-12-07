<?php
AppLoader::feature('setCRUDRoute');

Route::get('/admin', 'Admin/HomeAdminController@index');
Route::get('/admin/manager', 'Admin/HomeAdminController@index');
Route::get('/admin/dashboard', 'Admin/HomeAdminController@dashboard');

// Route::get('/admin/user/settings', 'Admin/HomeAdminController@index');
Route::get('/admin/manager/user/search', 'Admin/UserAdminController@searchData');

Route::get("/admin/team-manager", "Admin/TeamManagerAdminController@index");

// CRUD
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
