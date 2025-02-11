<?php

use App\Controllers\ErrorController;
use App\Features\Auth;
use App\Lib\DumpVar;
use App\Utils\Helpers\Route;
use App\Utils\Helpers\Store;

require_once 'web.php';

// Lấy URI và phương thức HTTP hiện tại
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$route = Route::match($requestUri, $requestMethod);

// Lấy tất cả các route
// DumpVar::dump(Route::getRoutes());

// 404
if (! $route) {
  $action = Auth::checkLogin()
    ? 'notFoundPage'
    : 'homePage';

  ErrorController::$action();
  exit();
}

// Lưu dữ liệu với key queryParams
Store::setQueryParams($route['queryParams']);

// Gọi controller và action
[$fullControllerPath, $action] = explode('@', $route['controllerPath']);

// Tách folder và controller từ fullControllerPath
$parts = explode('/', $fullControllerPath);
// $folder = implode('/', $parts);
$controller = "App\\Controllers\\".implode('\\', $parts);

$controllerInstance = new $controller();

// Gọi action và truyền các tham số nếu có
call_user_func_array([$controllerInstance, $action], $route['params']);
