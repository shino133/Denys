<?php
class Auth
{
  // Phương thức đăng nhập: thiết lập session nếu thông tin người dùng hợp lệ
  public static function set($key, $value)
  {
    if (!isset($_SESSION[$key])) {
      $_SESSION[$key] = $value;
    }

    return $_SESSION[$key] == $value;
  }

  // Phương thức đăng xuất: xóa session và chuyển hướng đến trang đăng nhập
  public static function logout($redirectTo = "/login")
  {
    session_unset();
    session_destroy();
    header("Location: " . BASE_URL . $redirectTo);
    exit;
  }

  // Phương thức kiểm tra xem người dùng đã đăng nhập hay chưa
  public static function check($key)
  {
    return isset($_SESSION[$key]);
  }

  // Phương thức cho username
  public static function setUser($username)
  {
    return self::set("username", $username);
  }

  public static function checkUser()
  {
    return self::check("username");
  }
}
