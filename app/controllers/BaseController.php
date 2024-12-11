<?php
class BaseController
{
  protected static $data = [];

  protected static function setData($key, $value): void
  {
    self::$data[$key] = $value;
  }

  protected static function setAllData($data)
  {
    self::$data = array_merge(self::$data, $data);
  }

  protected static function render($view, $useBaseLayout = true, $pathLayout = 'layout')
  {
    // dumpVar(self::$data);
    AppLoader::view('main', [
      'data' => self::$data,
      'pathView' => $view,
      'useBaseLayout' => $useBaseLayout,
      'pathLayout' => $pathLayout
    ]);
  }

  protected static function redirect($url)
  {
    header("Location: $url");
    exit();
  }

  protected static function reverse($query_string = null)
  {
    $action = function ($url, $query_string) {
      header("Location: " . $url . $query_string);
      exit();
    };

    $referer = $_SERVER['HTTP_REFERER'];
    if (isset($referer) == false) {
      $action('/', $query_string);
    }

    $parsed_url = parse_url($referer);
    $cleaned_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];

    $action($cleaned_url, $query_string);
  }
}
