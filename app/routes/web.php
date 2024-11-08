<?php
Route::get('/', 'HomeController@index');
Route::get('/about', 'PageController@about');
Route::get('/user', 'UserController@index');


Route::post('/contact', 'ContactController@submit');
