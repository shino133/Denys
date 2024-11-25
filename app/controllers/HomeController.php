<?php
AppLoader::model('PostModel');

class HomeController extends BaseController
{
  private $postModel;

  public function __construct()
  {
    $this->postModel = new PostModel();
  }

  public function index()
  {
    if (Auth::checkLogin() == false) {
      $this->redirect('/user/login');
    }
    
    $this->setData('user', Auth::get('username'));
    $this->setData('posts', $this->postModel->getNewestPost());

    Constants::homePage();
    $this->render('Home/main');
  }

}
