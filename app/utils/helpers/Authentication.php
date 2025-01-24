<?php
namespace App\Utils\Helpers;

class Authentication
{
  // Phương thức đăng nhập: thiết lập session nếu thông tin người dùng hợp lệ
  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
    return isset($_SESSION[$key]);
  }

  public static function get($key) {
    return $_SESSION[$key] ?? null;
  }

  // Phương thức đăng xuất: xóa session và chuyển hướng đến trang đăng nhập
  public static function logout()
  {
    session_unset();
    session_destroy();
  }

  // Phương thức kiểm tra xem người dùng đã đăng nhập hay chưa
  public static function check($key)
  {
    return isset($_SESSION[$key]);
  }

  public static function destroy($key) {
    if (isset($_SESSION[$key])) {
      unset($_SESSION[$key]);
    }
  }
}
