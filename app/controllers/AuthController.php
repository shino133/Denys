<?php
AppLoader::model('UserModel');

class AuthController extends BaseController
{
  private $model;
  private $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
  }
  public function actionDefault($nameAction)
  {
    $actionList = [
      // action => view
      'login' => 'Auth/Login',
      'register' => 'Auth/Register',
    ];

    if (!isset($actionList[$nameAction])) {
      $this->redirect('/404');
    }

    if (Auth::checkAdmin() == true) {
      $this->redirect('/admin');
    }

    if (Auth::checkLogin() == true) {
      $this->redirect('/');
    }

    Constants::loginPage();
    $this->render($actionList[$nameAction]);
  }

  public function register()
  {
    $this->actionDefault('register');
  }

  public function login()
  {
    $this->actionDefault('login');
  }

  public function loginRequest()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userData = $this->userModel->findByCondition(['username' => $username], 1);

    $this->redirect('/');

  }

  public function registerRequest()
  {
    $data = [
      'username' => $_POST['username'],
      'password' => $_POST['password'],
      'fullName' => $_POST['fullName'],
      'email' => $_POST['email'],
    ];
    
    $result = $this->userModel->create($data);
    if ($result) {
      $this->redirect('/user/login');
    }

    //WHEN: create fail
    $this->redirect('/user/register?errorMessage=Username already taken. Try another one');
  }

  public function logout()
  {
    Auth::logout();
    $this->redirect('/login');
  }
}