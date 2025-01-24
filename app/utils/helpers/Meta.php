<?php
namespace App\Utils\Helpers;

class Meta
{
  // Biến lưu trữ nội dung thẻ meta
  private static $metaTags = [];

  // Hàm tĩnh để thiết lập nội dung thẻ meta
  public static function setDescription($content)
  {
    self::$metaTags['description'] = $content;
  }

  public static function setKeywords($content)
  {
    self::$metaTags['keywords'] = $content;
  }

  public static function setTitle($content)
  {
    self::$metaTags['title'] = $content;
  }

  public static function setAuthor($content)
  {
    self::$metaTags['author'] = $content;
  }

  public static function setMetaTag($name, $content)
  {
    self::$metaTags[$name] = $content;
  }

  // Hàm tĩnh để hiển thị tất cả thẻ meta đã thiết lập
  public static function render()
  {
    foreach (self::$metaTags as $name => $content) {
      echo "<meta name=\"$name\" content=\"$content\">\n";
    }
  }
}
