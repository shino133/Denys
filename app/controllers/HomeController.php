<?php
class HomeController extends BaseController
{
  public function index()
  {
    Constants::home();
    Title::set(APP_NAME . ' - Social Networking Site');

    $this->render('Home/main');
  }
}
