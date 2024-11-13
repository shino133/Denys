<?php
require_once 'web.php';

// Lấy URI và phương thức HTTP hiện tại
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$route = Route::match($requestUri, $requestMethod);

// 404
if (!$route) {
  AppLoader::controller('ErrorController');
  (new ErrorController())->notFoundPage();
  exit();
}

Store::set('queryParams', $route['queryParams']);

// Gọi controller và action
[$controller, $action] = explode('@', $route['controller']);
AppLoader::controller($controller);
$controllerInstance = new $controller();

// Gọi action và truyền các tham số nếu có
call_user_func_array([$controllerInstance, $action], $route['params']);

