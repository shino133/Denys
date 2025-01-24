<?php
namespace App\Utils\Helpers;

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


  public static function delete($key)
  {
    unset(self::$data[$key]);
  }

  public static function setQueryParams($params = []): void
  {
    self::$data['queryParams'] = $params;
  }

  public static function getQueryParams(): array
  {
    return self::$data['queryParams'] ?? [];
  }
}