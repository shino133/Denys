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

    $this->render($actionList[$nameAction], false);
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

    Action::set('errorEvent', function ($msg = 'Something went wrong') {
      Url::setNofi(msg: $msg, status: 'error');
      $this->reverse(Url::getQueryString());
    });

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$username || !$password) {
      $msg = 'Vui lý nhập dữ liệu';
      Action::run('errorEvent', $msg);
    }

    // Check username valid
    if ($this->validUsername($username == true)) {
      $msg = 'Username chỉ có thể chứa chữ và số';
      Action::run('errorEvent', $msg);
    }

    // Check password valid
    if ($this->validPassword($password) == false) {
      $msg = 'Password phải có ít nhất 8 ký tự, 1 chữ thường, 1 chữ hoa, 1 số, 1 ký tự đặc biệt';
      Action::run('errorEvent', $msg);
    }

    $userData = $this->userModel->find(conditions: ['username' => $username], limit: 1)[0];

    if (!isset($userData) || $userData['status'] == 'delete') {
      $msg = "{$username} không tồn tại";
      Action::run('errorEvent', $msg);
    }

    $userData['password'] = decryptData($userData['password']);
    if (!($username == $userData['userName'] && $password == $userData['password'])) {
      $msg = 'Sai tài khoản hoặc mật khẻu';
      Action::run('errorEvent', $msg);
    }

    // get user public data
    AppLoader::controller('UserController');
    $userData = (new UserController())->validatePublicData($userData);
    
    // WHEN: login success
    Auth::setUser($userData);
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

    Action::set('errorEvent', function ($msg = 'Người dùng đã tồn tại') {
      Url::setNofi(msg: $msg, status: 'error');
      $this->reverse(Url::getQueryString());
    });

    $data = [
      'username' => $_POST['username'],
      'password' => $_POST['password'],
      'fullName' => $_POST['fullName'],
      'email' => $_POST['email'],
    ];

    $confirmPassword = $_POST['confirmPassword'];

    // Check null or empty data
    if (DataValidator::check($data) == false) {
      $msg = 'Vui lý nhập dữ liệu';
      Action::run('errorEvent', $msg);
    }

    if ($data['password'] !== $confirmPassword) {
      $msg = 'Mật khẩu không khớp';
      Action::run('errorEvent', $msg);
    }

    // Check full name valid
    if ($this->validFullName($data['fullName']) == false) {
      $msg = 'Tên không hợp le';
      Action::run('errorEvent', $msg);
    }

    // Check username valid
    if ($this->validUsername($data['username']) == true) {
      $msg = 'Username chỉ có thể chứa chữ và số';
      Action::run('errorEvent', $msg);
    }

    // Check password valid
    if ($this->validPassword($data['password']) == false) {
      $msg = 'Password phải có ít nhất 8 ký tự, 1 chữ thường, 1 chữ hoa, 1 số, 1 ký tự đặc biệt';
      Action::run('errorEvent', $msg);
    }

    // Check email valid
    if ($this->validEmail($data['email']) == false) {
      $msg = 'Email phải là email hợp lệ';
      Action::run('errorEvent', $msg);
    }
    $data['password'] = encryptData($data['password']);
    $result = $this->userModel->create($data);
    if (!$result) {
      Action::run('errorEvent', $msg);
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

  public function validPassword($password) {
    AppLoader::lib('isStrongPassword');
    return isStrongPassword($password);
  }

  public function validEmail($email) {
    AppLoader::lib('isValidEmail');
    return isValidEmail($email);
  }

  public function validUsername($username) {
    return preg_match('/[^a-zA-Z0-9\-\._]/', $username) === 1;
  }

  public function validFullName($fullName) {
    return preg_match('/^[\p{L}\s]+$/u', $fullName) === 1;
  }
}