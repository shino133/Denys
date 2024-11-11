<?php
AppLoader::model('UserModel');

class AuthController extends BaseController
{
  private $model;

  public function __construct() {
    $this->model = new UserModel();
  }
  public function action($nameAction)
  {
    $actionList = [
      'login' => 'Auth/Login',
      'register' => 'Auth/Register',
    ];

    if (!isset($actionList[$nameAction])) {
      echo '404 - Url not found';
      exit();
    }

    // WHEN: Logged in 
    $isUserLogin = Auth::checkUser();
    $isAdminLogin = Auth::checkAdmin();

    if ($isAdminLogin == true) {
      $this->redirect('/admin');
    }

    if ($isUserLogin == true) {
      $this->redirect('/');
    }

    Constants::loginPage();
    $this->render($actionList[$nameAction]);
  }

  public function actionRequest($nameAction)
  {
    $actionList = [
      'login' => 'Auth/Login',
      'register' => 'Auth/Register',
    ];

  }

  public function logout()
  {
    Auth::logout();
    $this->redirect('/login');
  }
}