<?php
class HomeController extends BaseController
{
  public function index()
  {
    if (Auth::checkLogin() == false) {
      $this->redirect('/user/login');
    }
    
    Constants::homePage();
    $this->render('Home/main');
  }

}
