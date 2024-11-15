<?php
class AppLoader
{
  // Core helpers
  public static function include($path, $data = [])
  {
    $fullPath = __DIR__ . '/../' . $path . ".php";

    // Kiểm tra nếu file tồn tại trước khi include
    if (file_exists($fullPath)) {
      extract($data);
      include_once $fullPath;
    } else {
      http_response_code(404);
      echo "404 - File not found: $fullPath";
    }
  }

  public static function getPath($path): string
  {
    return __DIR__ . '/../' . $path;
  }

  // Optional helpers
  public static function view($path, $data = [])
  {
    self::include("views/$path", $data);
  }

  public static function model($path, $isIncludeBase = true)
  {
    if ($isIncludeBase) {
      self::include("models/BaseModel");
    }
    self::include("models/$path");
  }

  public static function controller($path, $isIncludeBase = true)
  {
    if ($isIncludeBase) {
      self::include("controllers/BaseController");
    }
    self::include("controllers/$path");
  }

  public static function feature($path)
  {
    self::include("features/$path");
  }

  public static function helper($path)
  {
    self::include("features/helpers/$path");
  }

  public static function component($path)
  {
    self::include("components/$path");
  }

  public static function constant($path)
  {
    self::include("constants/$path");
  }

  public static function lib($path)
  {
    self::include("lib/$path");
  }

  public static function htmlToString($path, $data = [])
  {
    ob_start();
    if ($data) {
      extract($data);
    }
    self::view($path, $data);
    return ob_get_clean();
  }
}
