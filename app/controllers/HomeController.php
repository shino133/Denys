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

    // Set data for View
    self::setAllData(data: [
      'userData' => Auth::getUser(),
      'posts' => PostController::getNewPosts(),
    ]);

    Constants::homePage();
    self::render('Home/main');
  }

}
