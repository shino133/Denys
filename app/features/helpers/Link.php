<?php
class Link
{
  // Biến lưu trữ danh sách các thẻ link
  private static $links = [];

  // Phương thức để thêm thẻ link
  public static function addLink($rel, $href, $attributes = [])
  {
    self::$links[] = [
      'rel' => $rel,
      'href' => $href,
      'attributes' => $attributes
    ];
  }

  public static function addStylesheet($href, $attributes = []) {
    self::addLink('stylesheet', $href, $attributes);
  }
  public static function addShortcutIcon($href, $attributes = []) {
    self::addLink('shortcut icon', $href, $attributes);
  }

  public static function addJavascript($href, $attributes = []) {
    self::addLink('script', $href, $attributes);
  }



  // Phương thức để hiển thị tất cả các thẻ link đã thêm
  public static function renderLinks()
  {
    foreach (self::$links as $link) {
      $attrString = '';
      foreach ($link['attributes'] as $key => $value) {
        $attrString .= "$key=\"$value\" ";
      }

      echo "<link rel=\"{$link['rel']}\" href=\"{$link['href']}\" $attrString>\n";
    }
  }
}
