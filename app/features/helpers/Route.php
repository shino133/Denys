<?php
class Route
{
    // Lưu trữ tất cả các route
    private static $routes = [];

    // Định nghĩa route GET
    public static function get($uri, $controller)
    {
        self::$routes['GET'][$uri] = $controller;
    }

    // Định nghĩa route POST
    public static function post($uri, $controller)
    {
        self::$routes['POST'][$uri] = $controller;
    }

    // Lấy tất cả các route đã định nghĩa
    public static function getRoutes()
    {
        return self::$routes;
    }
}
