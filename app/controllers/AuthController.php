<?php
namespace App\Controllers;

use App\Constants\Constant;
use App\Features\Auth;
use App\Models\UserModel;
use App\Services\UserService;
use App\Utils\DataValidator;
use App\Utils\EmailUtil;
use App\Utils\Helpers\Action;
use App\Utils\Helpers\Title;
use App\Utils\Helpers\Url;
use App\Utils\PasswordUtil;

class AuthController extends Controller
{
  public static function actionDefault($nameAction)
  {
    $actionList = [
      // action => view
      'login' => 'Auth/Login',
      'register' => 'Auth/Register',
    ];

    if (! isset($actionList[$nameAction])) {
      $nameAction = 'login';
    }

    if (Auth::checkAdmin() == true) {
      self::redirect('/admin');
    }

    if (Auth::checkLogin() == true || Auth::checkUser() == true) {
      self::redirect('/');
    }

    Constant::loginPage();
    if ($nameAction == 'register') {
      Title::set(APP_NAME.' - Register');
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


    Action::set('errorEvent', function ($msg = 'Something went wrong') {
      Url::setNofi(msg: $msg, status: 'error');
      self::reverse(Url::getQueryString());
    });

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (! $username || ! $password) {
      $msg = 'Vui lòng nhập dữ liệu';
      Action::run('errorEvent', $msg);
    }

    // Check username valid
    if (self::validUsername($username) == false) {
      $msg = 'Username chỉ có thể chứa chữ và số';
      Action::run('errorEvent', $msg);
    }

    // Check password valid
    if (self::validPassword($password) == false) {
      $msg = 'Password phải có ít nhất 8 ký tự, 1 chữ thường, 1 chữ hoa, 1 số, 1 ký tự đặc biệt';
      Action::run('errorEvent', $msg);
    }

    $userData = UserModel::find(conditions: [
      'username' => $username,
    ], limit: 1)[0];

    if (! isset($userData) || $userData['status'] == 'delete') {
      $msg = "{$username} không tồn tại";
      Action::run('errorEvent', $msg);
    }

    // Check password
    $isCorrectPassword = PasswordUtil::verify(
      password: $password,
      hashedPassword: $userData['password']);

    if (! ($username == $userData['userName'] && $isCorrectPassword)) {
      $msg = 'Sai tài khoản hoặc mật khẩu';
      Action::run('errorEvent', $msg);
    }

    // get user public data
    $userData = UserService::validatePublicData($userData);

    // WHEN: login success
    Auth::setUser($userData);
    Auth::setLoginTime();

    if ((int) $userData['role'] === 1) {
      Auth::setAdmin($username);
    }

    if ((int) $userData['role'] === 0) {
      Auth::setAdminEditor($username);
    }

    if (Auth::checkAdmin() == true) {
      self::redirect('/admin/dashboard');
    }

    self::redirect('/');
  }

  public static function registerRequest()
  {
    Action::set('errorEvent', function ($msg = 'Người dùng đã tồn tại') {
      Url::setNofi(msg: $msg, status: 'error');
      self::reverse(Url::getQueryString());
    });

    self::registerRun();

    Url::setUrl('/user/login');
    Url::setNofi(msg: 'Registered', status: 'success');
    self::redirect(Url::get());
  }

  public static function registerRun(): bool|string
  {

    $data = [
      'username' => $_POST['username'],
      'password' => $_POST['password'],
      'fullName' => $_POST['fullName'],
      'email' => $_POST['email'],
    ];

    $confirmPassword = $_POST['confirmPassword'];

    // Check null or empty data
    if (DataValidator::check($data) == false) {
      $msg = 'Vui lòng nhập dữ liệu';
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
    if (self::validUsername($data['username']) == false) {
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

    // Check username exist
    $user = UserModel::find(conditions: ['username' => $data['username']], limit: 1)[0];
    if (isset($user)) {
      $msg = 'Username được dùng';
      Action::run('errorEvent', $msg);
    }

    // Check email exist
    $user = UserModel::find(conditions: ['email' => $data['email']], limit: 1)[0];
    if (isset($user)) {
      $msg = 'Email được dùng';
      Action::run('errorEvent', $msg);
    }

    $data['password'] = PasswordUtil::hash($data['password']);
    $result = UserModel::create($data);
    if ($result == false) {
      Action::run('errorEvent', $msg);
    }

    return $result;
  }


  public static function logout()
  {
    Auth::logout();
    self::redirect('/');
  }

  public static function getCurrentUserData($redirectToLogin = true): array|null
  {
    // Check login
    $userData = Auth::getUser();
    if (isset($userData) == false || empty($userData)) {
      $redirectToLogin ? self::redirectToLogin() : null;
      return null;
    }

    return $userData;
  }

  public static function redirectToLogin(): void
  {
    Auth::logout();
    Url::setUrl('/user/login');
    Url::setNofi('Vui lòng dăng nhập', 'error');
    self::redirect(Url::get());
  }

  public static function validPassword($password)
  {
    return PasswordUtil::isStrong($password);
  }

  public static function validEmail($email)
  {
    return EmailUtil::isValid($email);
  }

  public static function validUsername($username)
  {
    return preg_match('/[^a-zA-Z0-9\-\._]/', $username) !== 1;
  }

  public static function validFullName($fullName)
  {
    return preg_match('/^[\p{L}\s]+$/u', $fullName) === 1;
  }
}