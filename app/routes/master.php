<?php
require_once 'web.php';

// Lấy URI và phương thức HTTP hiện tại
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Lấy route khớp với URI hiện tại
$route = Route::match($requestUri, $requestMethod);

if ($route) {
  list($controller, $action) = explode('@', $route['controller']);

  // Gọi controller và action
  AppLoader::controller($controller);
  $controllerInstance = new $controller();

  // Gọi action và truyền các tham số nếu có
  call_user_func_array([$controllerInstance, $action], $route['params']);
} else {
  // Nếu không tìm thấy route, trả về trang 404
  http_response_code(404);
  echo "404 - URL not found";
}
