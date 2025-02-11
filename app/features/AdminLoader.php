<?php
namespace App\Features;

class AdminLoader extends AppLoader
{
  // Optional helpers
  public static function view($path, $data = [])
  {
    self::include("Views/Admin/$path", $data);
  }

  public static function component($path, $data = [], $include_once = false)
  {
    self::include("Components/Admin/$path", $data, $include_once);
  }

  public static function constant($path)
  {
    self::include("Constants/Admin/$path");
  }
}
