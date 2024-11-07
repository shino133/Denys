<?php
app_helper('Route');

// Định nghĩa route cho ứng dụng
Route::get('/', 'HomeController@index'); 
Route::get('/about', 'PageController@about'); 


Route::post('/contact', 'ContactController@submit');
