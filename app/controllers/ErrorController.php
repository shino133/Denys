<?php
class ErrorController extends BaseController {


  public function notFoundPage($render = true) {
    if (!$render) {
      $this->redirect('/404');
    }
    $this->render('404', false);
  }
}