<?php
class BaseController
{
  // Biến lưu trữ dữ liệu sẽ được truyền cho view
  protected $data = [];

  // Phương thức để thiết lập dữ liệu cho view
  protected function setData($key, $value)
  {
    $this->data[$key] = $value;
  }

  // Phương thức render view
  protected function render($view)
  {
    app_view($view, $this->data);
  }

  // Phương thức xử lý redirect
  protected function redirect($url)
  {
    header("Location: $url");
    exit();
  }
}
