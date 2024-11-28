<?php
class ErrorController extends BaseController {

  public static function notFoundPage($render = true) {
    if (!$render) {
      self::redirect('/404');
    }
    self::render('404', false);
  }
}