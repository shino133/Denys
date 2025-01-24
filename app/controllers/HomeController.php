<?php
namespace App\Controllers;

use App\Constants\Constant;
use App\Features\Auth;

class HomeController extends Controller
{
  public static function index()
  {
    if (Auth::checkLogin() == false) {
      self::redirect('/user/login');
    }
    
    // Set data for View
    self::setAllData(data: [
      'userData' => Auth::getUser(),
      'posts' => PostController::getNewPosts(),
    ]);

    Constant::homePage();
    self::render('Home/main');
  }

}
