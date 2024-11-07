<?php
class AppLoader
{
  // Hàm include một file với đường dẫn từ thư mục gốc
  public static function include($path, $data = [])
  {
    $fullPath = __DIR__ . '/../' . $path . ".php";

    // Kiểm tra nếu file tồn tại trước khi include
    if (file_exists($fullPath)) {
      include_once $fullPath;
    } else {
      echo "File không tồn tại: $fullPath";
    }
  }

  // Hàm include một file view từ thư mục views
  public static function view($path, $data = [])
  {
    self::include("views/$path", $data);
  }

  // Hàm include một model từ thư mục models, kèm tùy chọn include BaseModel
  public static function model($path, $isIncludeBase = true)
  {
    if ($isIncludeBase) {
      self::include("models/BaseModel");
    }
    self::include("models/$path");
  }

  // Hàm include một controller từ thư mục controllers, kèm tùy chọn include BaseController
  public static function controller($path, $isIncludeBase = true)
  {
    if ($isIncludeBase) {
      self::include("controllers/BaseController");
    }
    self::include("controllers/$path");
  }

  // Hàm include một feature từ thư mục features
  public static function feature($path)
  {
    self::include("features/$path");
  }

  // Hàm include một helper từ thư mục features/helpers
  public static function helper($path)
  {
    self::include("features/helpers/$path");
  }

  // Hàm include một component từ thư mục components
  public static function component($path)
  {
    self::include("components/$path");
  }
}
