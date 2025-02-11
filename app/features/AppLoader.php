<?php
namespace App\Features;

use App\Utils\Helpers\Loader;

class AppLoader extends Loader
{
  // Optional helpers
  public static function view($path, $data = [])
  {
    return self::include("Views/$path", $data);
  }

  public static function model($path)
  {
    self::include("Models/$path");
  }

  public static function controller($path)
  {
    self::include("Controllers/$path");
  }

  public static function feature($path)
  {
    self::include("Features/$path");
  }

  public static function util($path)
  {
    self::include("Utils/$path");
  }

  public static function helper($path)
  {
    self::include("Utils/Helpers/$path");
  }

  public static function component($path, $data = [], $include_once = false)
  {
    return self::include("Components/$path", $data, $include_once);
  }

  public static function constant($path)
  {
    return self::include("Constants/$path");
  }

  public static function lib($path)
  {
    self::include("Lib/$path");
  }

  public static function routeAccess($path)
  {
    self::include("Routes/Access/$path");
  }
}
