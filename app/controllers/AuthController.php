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
      throw new Exception('Action not found', 404);
    }

    if (Auth::checkAdmin() == true) {
      $this->redirect('/admin');
    }

    if (Auth::checkLogin() == true || Auth::checkUser() == true) {
      $this->redirect('/');
    }

    Constants::loginPage();
    if ($nameAction == 'register') {
      Title::set(APP_NAME . ' - Register');
    }
    
    $this->render($actionList[$nameAction]);
  }

  public function register()
  {
    try {
      $this->actionDefault('register');
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function login()
  {
    try {
      $this->actionDefault('login');
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function loginRequest()
  {
    Url::setUrl('/user/login');
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!$username || !$password) {
      Url::setNofi(msg: 'invalid_username_or_password', status: 'error');
      $this->redirect(Url::get());
    }

    $userData = $this->userModel->find(conditions: ['username' => $username], limit: 1)[0];

    if (!isset($userData)) {
      Url::setNofi(msg: 'invalid_username_or_password', status: 'error');
      $this->redirect(Url::get());
    }

    $password = encryptData($password);

    if (!($username == $userData['userName'] || $password == $userData['password'])) {
      Url::setNofi(msg: 'invalid_username_or_password', status: 'error');
      $this->redirect(Url::get());
    }

    // WHEN: login success
    Auth::setUser($username);
    if ($userData['role'] == 1) {
      Auth::setAdmin($username);
      $this->redirect('/admin');
    }

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
      Url::setNofi(msg: 'invalid_data', status: 'error'); 
      $this->redirect(Url::get());
    }

    $data['password'] = encryptData($data['password']);
    $result = $this->userModel->create($data);
    if (!$result) {
      Url::setNofi(msg: 'something_went_wrong', status: 'error');
      $this->redirect(Url::get());
    }

    Url::setUrl('/user/login'); 
    Url::setNofi(msg: 'Registered', status: 'success');
    $this->redirect(Url::get());
  }

  public function logout()
  {
    Auth::logout();
    $this->redirect('/');
  }
}