<?php
class HomeController extends BaseController
{
  public function index()
  {
    // Đặt dữ liệu cho view
    $this->setData('title', 'Trang chủ');
    $this->setData('message', 'Chào mừng đến với trang chủ của chúng tôi!');

    // Gọi view
    $this->render('Home/main');
  }
}
