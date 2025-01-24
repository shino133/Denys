<?php
namespace App\Controllers;

use App\Features\Auth;
use App\Utils\Helpers\Url;

class ErrorController extends Controller
{

  public static function notFoundPage($isJustRender = true)
  {
    if (! $isJustRender) {
      self::redirect('/404');
    }
    self::render('404', false);
  }

  public static function homePage()
  {
    $url = '/';

    if (Auth::checkLogin() == false) {
      Url::set('/user/login');
      Url::setNofi(msg: 'Vui lòng dăng nhập', status: 'error');
      $url = Url::get();
    }

    self::redirect($url);
  }
}