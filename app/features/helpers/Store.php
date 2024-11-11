<?php
class Store
{
// Mảng tĩnh để lưu trữ dữ liệu
private static $data = [];

// Phương thức để lưu dữ liệu
public static function set($key, $value)
{
self::$data[$key] = $value;
}

// Phương thức để lấy dữ liệu
public static function get($key, $default = null)
{
// Kiểm tra xem key có tồn tại không, nếu có thì trả về, nếu không thì trả về giá trị mặc định
return self::$data[$key] ?? $default;
}
}