<?php
namespace App\Utils\Helpers;

class Script
{
  // Biến lưu trữ danh sách các thẻ script, phân chia theo vị trí
  private static $scripts = [
    'head' => [],
    'body' => []
  ];

  // Phương thức thêm file script bên ngoài, kèm vị trí
  public static function addExternalScript($src, $attributes = [], $position = 'body')
  {
    self::$scripts[$position][] = [
      'type' => 'external',
      'attributes' => $attributes,
      'src' => $src,
    ];
  }

  // Phương thức thêm mã script inline, kèm vị trí
  public static function addInlineScript($content, $attributes = [], $position = 'body')
  {
    self::$scripts[$position][] = [
      'type' => 'inline',
      'attributes' => $attributes,
      'content' => $content,
    ];
  }

  // Phương thức render các thẻ script theo vị trí
  public static function render($position = 'body')
  {
    if (!isset(self::$scripts[$position])) {
      return;
    }

    foreach (self::$scripts[$position] as $script) {
      $attrString = '';
      foreach ($script['attributes'] as $key => $value) {
        if ($value == null){
          $attrString .= "$key ";
          continue;
        }

        $attrString .= "$key=\"$value\" ";
      }

      if ($script['type'] === 'external') {
        echo "<script $attrString src=\"{$script['src']}\" ></script>\n";
      } elseif ($script['type'] === 'inline') {
        echo "<script $attrString>" . $script['content'] ."</script>\n";
      }
    }
  }
}
