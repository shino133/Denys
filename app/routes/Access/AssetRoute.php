<?php
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