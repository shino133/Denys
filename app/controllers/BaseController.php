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
}
