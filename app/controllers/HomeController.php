<?php
class HomeController extends BaseController
{
  private $postModel;

  public static function index()
  {
    if (Auth::checkLogin() == false) {
      self::redirect('/user/login');
    }
    
    AppLoader::controller('PostController');

    self::setData('userData', Auth::getUser());
    self::setData('posts', PostController::getNewPosts());

    Constants::homePage();
    self::render('Home/main');
  }

}
