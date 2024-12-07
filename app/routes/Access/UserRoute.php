<?php
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
