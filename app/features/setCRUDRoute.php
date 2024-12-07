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