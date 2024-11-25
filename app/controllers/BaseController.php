<?php
class BaseController
{
  protected $data = [];
  protected $dataKeyConstants = [
    'pathView' => 'path to view'
  ];

  protected function setData($key, $value)
  {
    if (!isset($dataKeyConstants[$key])) {
      $this->data[$key] = $value;
    }

    return $this->data[$key] == $value;
  }

  protected function render($view, $useBaseLayout = true)
  {
    $pathView = $view;

    if ($useBaseLayout) {
      $this->data['pathView'] = $pathView;
      $pathView = 'layout';
    }

    AppLoader::view($pathView, $this->data);
  }

  protected function redirect($url)
  {
    header("Location: $url");
    exit();
  }

  protected function reverse($query_string = null)
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
