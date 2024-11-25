<?php
class HomeController extends BaseController
{
  public function index()
  {
    Constants::homeAdmin();
    Title::set('Admin Home - ' . APP_NAME);

    $this->render('Admin/Home/main');
  }

}
