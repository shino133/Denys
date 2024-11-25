<?php
class AppLoader extends Loader
{
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

  public static function util($path)
  {
    self::include("utils/$path");
  }

  public static function helper($path)
  {
    self::include("utils/helpers/$path");
  }

  public static function component($path, $data = [], $include_once = false)
  {
    self::include("components/$path", $data, $include_once);
  }

  public static function constant($path)
  {
    self::include("constants/$path");
  }

  public static function lib($path)
  {
    self::include("lib/$path");
  }
}
