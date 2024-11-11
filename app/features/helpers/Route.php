<?php

class Route
{
    private static $routes = [];
    private static $dynamicRoutes = [];

    // Định nghĩa route GET
    public static function get($uri, $controller)
    {
        if (strpos($uri, '{') === false) {
            // Thêm vào route cố định
            self::$routes['GET'][$uri] = $controller;
        } else {
            // Thêm vào route động
            self::$dynamicRoutes['GET'][$uri] = $controller;
        }
    }

    // Định nghĩa route POST
    public static function post($uri, $controller)
    {
        if (strpos($uri, '{') === false) {
            self::$routes['POST'][$uri] = $controller;
        } else {
            self::$dynamicRoutes['POST'][$uri] = $controller;
        }
    }

    // Lấy tất cả các route đã định nghĩa
    public static function getRoutes()
    {
        return self::$routes;
    }

    // So khớp route với URI và lấy tham số nếu có
    public static function match($requestUri, $requestMethod)
    {
        // Loại bỏ các tham số truy vấn khỏi URI
        $parsedUrl = parse_url($requestUri);
        $path = $parsedUrl['path'];

        // Kiểm tra route cố định trước
        if (isset(self::$routes[$requestMethod][$requestUri])) {
            return [
                'controller' => self::$routes[$requestMethod][$requestUri],
                'params' => []
            ];
        }

        // Kiểm tra route động nếu không có route cố định
        foreach (self::$dynamicRoutes[$requestMethod] as $uri => $controller) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $uri);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches); // Bỏ phần khớp toàn bộ
                return [
                    'controller' => $controller,
                    'params' => $matches,
                ];
            }
        }

        return null;
    }
}
