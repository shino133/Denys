<?php
AppLoader::model('UserModel');
AppLoader::lib("encryptData");
AppLoader::helper('DataValidator');

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
    Url::setUrl('/user/login');
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!$username || !$password) {
      Url::setQueryString(['errorMessage' => 'empty_fields']);
      $this->redirect(Url::get());
    }

    $userData = $this->userModel->findByCondition(conditions: ['username' => $username], limit: 1)[0];

    if (!isset($userData)) {
      Url::setQueryString(['errorMessage' => 'user_not_found']);
      $this->redirect(Url::get());
    }

    $password = encryptData($password);

    if (!($username == $userData['userName'] || $password == $userData['password'])) {
      Url::setQueryString(['errorMessage' => 'invalid_username_or_password']);
      $this->redirect(Url::get());
    }

    Auth::setUser($username);
    $this->redirect('/');
  }

  public function registerRequest()
  {
    Url::setUrl('/user/register');
    $data = [
      'username' => $_POST['username'],
      'password' => $_POST['password'],
      'fullName' => $_POST['fullName'],
      'email' => $_POST['email'],
    ];

    $isValidData = DataValidator::check($data);
    if (!$isValidData) {
      Url::setQueryString(['errorMessage' => 'empty_fields']);
      $this->redirect(Url::get());
    }

    $data['password'] = encryptData($data['password']);
    $result = $this->userModel->create($data);
    if (!$result) {
      Url::setQueryString(['errorMessage' => 'username_already_taken']);
      $this->redirect(Url::get());
    }

    $this->redirect('/user/login?notification=registered');
  }

  public function logout()
  {
    Auth::logout();
    $this->redirect('/login');
  }
}