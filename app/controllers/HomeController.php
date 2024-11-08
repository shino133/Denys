<?php
class HomeController extends BaseController
{
  public function index()
  {
    // Đặt dữ liệu cho view
    $this->setData('title', 'Trang chủ');
    $this->setData('message', 'Chào mừng gì đó');

    $this->setData(
      'products',
      [
        'id' => 1,
        'name' => 'Sản phẩm 1',
        'price' => 100000
      ]
    );

    // Gọi view
    $this->render('Home/main');
  }
}
