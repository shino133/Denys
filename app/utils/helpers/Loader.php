<?php
class Loader
{
  // Core helpers
  public static function include($path, $data = [], $include_once = true)
  {
    $fullPath = __DIR__ . '/../../' . $path . ".php";

    // Kiểm tra nếu file tồn tại trước khi include
    if (file_exists($fullPath)) {
      extract($data);
      $include_once
        ? include_once $fullPath
        : include $fullPath;
    } else {
      http_response_code(404);
      echo "404 - File not found: $fullPath";
    }
  }

  public static function getPath($path): string
  {
    return __DIR__ . '/../../' . $path;
  }

  public static function htmlToString($path, $data = [])
  {
    ob_start();
    if ($data) {
      extract($data);
    }
    self::include($path, $data);
    return ob_get_clean();
  }
}
