<?php
class BaseController
{
  protected $data = [];

  protected function setData($key, $value)
  {
    $this->data[$key] = $value;
  }

  protected function render($view)
  {
    app_view($view, $this->data);
  }

  protected function redirect($url)
  {
    header("Location: $url");
    exit();
  }
}
