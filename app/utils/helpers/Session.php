<?php
namespace App\Utils\Helpers;

class Session
{
  /**
   * Khởi động session nếu chưa khởi động.
   */
  public static function start()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();  // Chỉ khởi động nếu session chưa được bắt đầu
    }
  }

  /**
   * Lấy giá trị từ session.
   */
  public static function get($key): ?array
  {
    self::start();  // Đảm bảo session đã khởi động
    return $_SESSION[$key] ?? null;
  }

  /**
   * Ghi giá trị vào session.
   */
  public static function put($key, $value)
  {
    self::start();  // Đảm bảo session đã khởi động
    $_SESSION[$key] = $value;
  }

  /**
   * Xóa giá trị khỏi session.
   */
  public static function delete($key)
  {
    self::start();  // Đảm bảo session đã khởi động
    unset($_SESSION[$key]);
  }

  /**
   * Đóng session.
   */
  public static function close()
  {
    session_write_close();  // Đóng session để ngừng sử dụng
  }
}
