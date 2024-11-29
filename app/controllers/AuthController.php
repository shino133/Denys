<?php
AppLoader::model('UserModel');

class AuthController extends BaseController
{
  public static function actionDefault($nameAction)
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
      self::redirect('/admin');
    }

    if (Auth::checkLogin() == true || Auth::checkUser() == true) {
      self::redirect('/');
    }

    Constants::loginPage();
    if ($nameAction == 'register') {
      Title::set(APP_NAME . ' - Register');
    }

    self::render($actionList[$nameAction], false);
  }

  public static function register()
  {
    self::actionDefault('register');
  }

  public static function login()
  {
    self::actionDefault('login');
  }

  public static function loginRequest()
  {
    AppLoader::lib('encryptData');

    Action::set('errorEvent', function ($msg = 'Something went wrong') {
      Url::setNofi(msg: $msg, status: 'error');
      self::reverse(Url::getQueryString());
    });

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$username || !$password) {
      $msg = 'Vui lý nhập dữ liệu';
      Action::run('errorEvent', $msg);
    }

    // Check username valid
    if (self::validUsername($username == true)) {
      $msg = 'Username chỉ có thể chứa chữ và số';
      Action::run('errorEvent', $msg);
    }

    // Check password valid
    if (self::validPassword($password) == false) {
      $msg = 'Password phải có ít nhất 8 ký tự, 1 chữ thường, 1 chữ hoa, 1 số, 1 ký tự đặc biệt';
      Action::run('errorEvent', $msg);
    }

    $userData = UserModel::find(conditions: ['username' => $username], limit: 1)[0];

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
    $userData = UserModel::validatePublicData($userData);

    // WHEN: login success
    Auth::setUser($userData);
    if ($userData['role'] == 1) {
      Auth::setAdmin($username);
      self::redirect('/admin/dashboard');
    }

    self::redirect('/');
  }

  public static function registerRequest()
  {
    AppLoader::util('DataValidator');
    AppLoader::lib('encryptData');

    Action::set('errorEvent', function ($msg = 'Người dùng đã tồn tại') {
      Url::setNofi(msg: $msg, status: 'error');
      self::reverse(Url::getQueryString());
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
    if (self::validFullName($data['fullName']) == false) {
      $msg = 'Tên không hợp le';
      Action::run('errorEvent', $msg);
    }

    // Check username valid
    if (self::validUsername($data['username']) == true) {
      $msg = 'Username chỉ có thể chứa chữ và số';
      Action::run('errorEvent', $msg);
    }

    // Check password valid
    if (self::validPassword($data['password']) == false) {
      $msg = 'Password phải có ít nhất 8 ký tự, 1 chữ thường, 1 chữ hoa, 1 số, 1 ký tự đặc biệt';
      Action::run('errorEvent', $msg);
    }

    // Check email valid
    if (self::validEmail($data['email']) == false) {
      $msg = 'Email phải là email hợp lệ';
      Action::run('errorEvent', $msg);
    }
    
    $data['password'] = encryptData($data['password']);
    $result = UserModel::create($data);
    if (!$result) {
      Action::run('errorEvent', $msg);
    }

    Url::setUrl('/user/login');
    Url::setNofi(msg: 'Registered', status: 'success');
    self::redirect(Url::get());
  }

  public static function logout()
  {
    Auth::logout();
    self::redirect('/');
  }

  public static function validPassword($password)
  {
    AppLoader::lib('isStrongPassword');
    return isStrongPassword($password);
  }

  public static function validEmail($email)
  {
    AppLoader::lib('isValidEmail');
    return isValidEmail($email);
  }

  public static function validUsername($username)
  {
    return preg_match('/[^a-zA-Z0-9\-\._]/', $username) === 1;
  }

  public static function validFullName($fullName)
  {
    return preg_match('/^[\p{L}\s]+$/u', $fullName) === 1;
  }
}