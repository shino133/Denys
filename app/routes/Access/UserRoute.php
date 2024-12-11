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
Route::get('/user/profile', 'UserProfileController@profilePage');
Route::get('/user/profile', 'UserProfileController@profilePage');
Route::post('/user/profile/avatar/upload/request', 'UserProfileController@uploadAvatar');
Route::post('/user/profile/banner/upload/request', 'UserProfileController@uploadBanner');


// Follow
Route::post('/user/follow/request/@{username}', 'UserFollowController@followRequest');
Route::post('/user/unfollow/request/@{username}', 'UserFollowController@unfollowRequest');


// Post CRUD
Route::post('/post/request/add', 'PostController@addPost');
Route::post('/post/request/edit/{id}', 'PostController@editPost');
Route::post('/post/request/destroy/{id}', 'PostController@destroyPost');

Route::get('/post/{postId}', 'PostController@postPage');
Route::get('/post/new/{offset}', 'PostController@renderNewPosts');

// Comment
Route::post('/comment/request/add/{postId}', 'CommentController@addComment');

// Like
Route::post('/like/request/add/{postId}', 'LikeController@addLike');
Route::delete('/like/request/destroy/{postId}', 'LikeController@destroyLike');

// Search
Route::get('/search', 'SearchController@index');
Route::post('/search/request', 'SearchController@searchData');

