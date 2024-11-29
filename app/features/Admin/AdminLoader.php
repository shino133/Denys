<?php
class AdminLoader extends AppLoader
{
  // Optional helpers
  public static function view($path, $data = [])
  {
    self::include("views/Admin/$path", $data);
  }

  public static function controller($path, $isIncludeBase = true)
  {
    if ($isIncludeBase) {
      self::include("controllers/BaseController");
    }
    self::include("controllers/Admin/$path");
  }

  public static function component($path, $data = [], $include_once = false)
  {
    self::include("components/Admin/$path", $data, $include_once);
  }

  public static function constant($path)
  {
    self::include("constants/Admin/$path");
  }
}
