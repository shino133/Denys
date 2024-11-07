<?php
require_once 'web.php';

// Lấy URI và phương thức HTTP hiện tại
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Lấy tất cả route đã định nghĩa
$routes = Route::getRoutes();

// Kiểm tra và xử lý route
if (isset($routes[$requestMethod][$requestUri])) {
  list($controller, $action) = explode('@', $routes[$requestMethod][$requestUri]);

  // Gọi controller và action
  app_controller($controller);
  $controllerInstance = new $controller();
  $controllerInstance->$action();
} else {
  // Nếu không tìm thấy route, trả về trang 404
  http_response_code(404);
  echo "404 - Not Found";
}
