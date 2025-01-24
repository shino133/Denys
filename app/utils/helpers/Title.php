<?php
namespace App\Utils\Helpers;

class Title
{
  private static $title = '';

  static function set($content)
  {
    self::$title = $content;
  }

  static function render()
  {
    echo "<title>" . self::$title . "</title>";
  }
}
