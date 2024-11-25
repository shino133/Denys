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
      $nameAction = 'login';
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
    $this->actionDefault('register');
  }

  public function login()
  {
    $this->actionDefault('login');
  }

  public function loginRequest()
  {
    AppLoader::lib('encryptData');
    Url::setUrl('/user/login');
    $errorEvent = function () {
      Url::setNofi(msg: 'Invalid_username_or_password', status: 'error');
      $this->redirect(Url::get());
    };

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$username || !$password) {
      $errorEvent();
    }

    $userData = $this->userModel->find(conditions: ['username' => $username], limit: 1)[0];

    if (!isset($userData)) {
      $errorEvent();
    }

    $userData['password'] = decryptData($userData['password']);
    if (!($username == $userData['userName'] && $password == $userData['password'])) {
      $errorEvent();
    }

    // WHEN: login success
    Auth::setUser($username);
    Auth::set('user_id', $userData['id']);
    if ($userData['role'] == 1) {
      Auth::setAdmin($username);
      $this->redirect('/admin');
    }

    $this->redirect('/');
  }

  public function registerRequest()
  {
    AppLoader::util('DataValidator');
    AppLoader::lib('encryptData');
    Url::setUrl('/user/register');
    $errorEvent = function ($msg = 'Something_went_wrong') {
      Url::setNofi(msg: $msg, status: 'error');
      $this->redirect(Url::get());
    };

    $data = [
      'username' => $_POST['username'],
      'password' => $_POST['password'],
      'fullName' => $_POST['fullName'],
      'email' => $_POST['email'],
    ];

    if (DataValidator::check($data) == false) {
      $errorEvent('Invalid_input');
    }

    $data['password'] = encryptData($data['password']);
    $result = $this->userModel->create($data);
    if (!$result) {
      $errorEvent();
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