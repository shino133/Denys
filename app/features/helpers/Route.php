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

    // Định nghĩa route PUT
    public static function put($uri, $controller)
    {
        if (strpos($uri, '{') === false) {
            self::$routes['PUT'][$uri] = $controller;
        } else {
            self::$dynamicRoutes['PUT'][$uri] = $controller;
        }
    }

    // Định nghĩa route DELETE
    public static function delete($uri, $controller)
    {
        if (strpos($uri, '{') === false) {
            self::$routes['DELETE'][$uri] = $controller;
        } else {
            self::$dynamicRoutes['DELETE'][$uri] = $controller;
        }
    }

    // Lấy tất cả các route đã định nghĩa
    public static function getRoutes()
    {
        return self::$routes;
    }

    // So khớp route với URI và lấy tham số nếu có
    public static function match($requestUri, $requestMethod): array|null
    {
        // Loại bỏ các tham số truy vấn khỏi URI
        $parsedUrl = parse_url($requestUri);

        $requestUri = $parsedUrl['path'];

        $queryParams = [];
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        }
        
        // Kiểm tra route cố định trước
        if (isset(self::$routes[$requestMethod][$requestUri])) {
            return [
                'controllerPath' => self::$routes[$requestMethod][$requestUri],
                'queryParams' => $queryParams,
                'params' => []
            ];
        }

        
        if (!isset(self::$dynamicRoutes[$requestMethod])) {
            return null;
        }
        // Kiểm tra route động nếu không có route cố định
        foreach (self::$dynamicRoutes[$requestMethod] as $uri => $controller) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $uri);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches); // Bỏ phần khớp toàn bộ
                return [
                    'controller' => $controller,
                    'queryParams' => $queryParams,
                    'params' => $matches,
                ];
            }
        }

        return null;
    }
}
