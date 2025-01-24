<?php

use App\Features\CRUDRoute;
use App\Utils\Helpers\Route;

Route::get('/admin', 'Admin/HomeAdminController@index');
Route::get('/admin/manager', 'Admin/HomeAdminController@index');
Route::get('/admin/dashboard', 'Admin/HomeAdminController@dashboard');

// Route::get('/admin/user/settings', 'Admin/HomeAdminController@index');
Route::get('/admin/manager/user/search', 'Admin/UserAdminController@searchData');

Route::get('/admin/settings', 'Admin/SettingController@index');
Route::get('/admin/settings/password', 'Admin/SettingController@passwordPage');
Route::post('/admin/settings/password/request', 'SettingController@passwordPageRequest');

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
  'comment' => [
    'url' => '/admin/manager/comment',
    'controller' => 'Admin/CommentAdminController',
  ],
];

foreach ($routerCRUD as $key => $value) {
  CRUDRoute::set($value['url'], $value['controller']);
}
