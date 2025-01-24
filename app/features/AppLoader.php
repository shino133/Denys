<?php
namespace App\Features;

use App\Utils\Helpers\Loader;

class AppLoader extends Loader
{
  // Optional helpers
  public static function view($path, $data = [])
  {
    return self::include("views/$path", $data);
  }

  public static function model($path)
  {
    self::include("models/$path");
  }

  public static function controller($path)
  {
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
    return self::include("components/$path", $data, $include_once);
  }

  public static function constant($path)
  {
    return self::include("constants/$path");
  }

  public static function lib($path)
  {
    self::include("lib/$path");
  }

  public static function routeAccess($path)
  {
    self::include("routes/Access/$path");
  }
}
