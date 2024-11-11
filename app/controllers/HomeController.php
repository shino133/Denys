<?php
class HomeController extends BaseController
{
  public function index()
  {
    $isLogin = Auth::check('username');
    if (!$isLogin) {
      $this->redirect('login');
    }
    Constants::homePage();
    Title::set(APP_NAME . ' - Social Networking Site');

    $this->render('Home/main');
  }

}
