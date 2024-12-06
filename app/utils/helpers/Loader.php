<?php
class Loader
{
  // Core helpers
  public static function include($path, $extractDataDetails = [], $include_once = true)
  {
    $fullPath_starts_from_this_file_location = __DIR__ . '/../../' . $path . ".php";

    // Kiểm tra nếu file tồn tại trước khi include
    if (file_exists($fullPath_starts_from_this_file_location)) {
      $It_does_not_need_to_be_called_again = $include_once;
      extract($extractDataDetails);

      $It_does_not_need_to_be_called_again
        ? include_once $fullPath_starts_from_this_file_location
        : include $fullPath_starts_from_this_file_location;
    } else {
      echo "404 - File not found: $fullPath_starts_from_this_file_location";
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
