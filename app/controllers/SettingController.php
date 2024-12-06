<?php
class SettingController extends BaseController
{
  public static function index()
  {
    self::redirect('/user/settings/account');
  }

  public static function accountPage()
  {
    Constants::settingPage();
    AppLoader::controller('UserController');

    // Get current user
    $userData = UserController::getCurrentUserData();
    // dumpVar($userData);

    // Set data and render
    self::setData('userData', $userData);
    self::render('Setting/Account/main');
  }

  public static function contactPage()
  {
    Constants::settingPage();
    self::render('Setting/Contact/main');
  }

  public static function accountPageRequest()
  {
    AppLoader::lib('encryptData');
    AppLoader::util('DataValidator');
    AppLoader::controller('AuthController');

    Action::set('reverse', function ($msg = 'Something went wrong', $status = 'error') {
      Url::setNofi(msg: $msg, status: $status);
      self::reverse(Url::getQueryString());
    });

    Action::set('errorEvent', function ($msg = 'Something went wrong') {
      Action::run('reverse', $msg, 'error');
    });

    $postData = [
      'fullName' => $_POST['fullName'] ?? null,
      'email' => $_POST['email'] ?? null,
      'userName' => $_POST['userName'] ?? null,
      'password' => $_POST['password'] ?? null,
    ];

    // Check null or empty data
    if (DataValidator::check($postData) == false) {
      $msg = 'Vui lòng nhập đầy đủ dữ liệu';
      Action::run('errorEvent', $msg);
    }

    // Check full name valid
    if (AuthController::validFullName($postData['fullName']) == false) {
      $msg = 'Họ tên không hợp lệ';
      Action::run('errorEvent', $msg);
    }

    // Check email valid
    if (AuthController::validEmail($postData['email']) == false) {
      $msg = 'Email không hợp lệ';
      Action::run('errorEvent', $msg);
    }

    // Check username valid
    if (AuthController::validUsername($postData['userName']) == false) {
      $msg = 'Username chi chỉ có thể chứa chữ và số';
      Action::run('errorEvent', $msg);
    }

    // Check password valid
    if (AuthController::validPassword($postData['password']) == false) {
      $msg = 'Password phải có ít nhất 8 ký tự, 1 chữ thường, 1 chữ hoa, 1 số, 1 ký tự đặc biệt';
      Action::run('errorEvent', $msg);
    }

    // Get current user
    AppLoader::controller('UserController');
    $userCurrentData = UserController::getCurrentUserData();

    // Check password
    $passwordCorrect = decryptData($userCurrentData['password']);
    if ($postData['password'] !== $passwordCorrect) {
      $msg = 'Mật khẩu không chính xác';
      Action::run('errorEvent', $msg);
    }

    // Set data
    $data = [
      'fullName' => $postData['fullName'] ?? $userCurrentData['fullName'],
      'email' => $postData['email'] ?? $userCurrentData['email'],
      'userName' => $postData['userName'] ?? $userCurrentData['userName'],
    ];

    // Check Email exist
    if ($postData['email'] !== $userCurrentData['email']) {
      $emailExist = UserModel::find(
        conditions: ['email' => $data['email']],
        columns: ['id'],
        limit: 1);
      if (! empty($emailExist)) {
        $msg = 'Email đã tồn tại';
        Action::run('errorEvent', $msg);
      }
    }

    // Check Username exist
    if ($postData['userName'] !== $userCurrentData['userName']) {
      $userNameExist = UserModel::find(
        conditions: ['userName' => $data['userName']],
        columns: ['id'],
        limit: 1);
      if (! empty($userNameExist)) {
        $msg = 'Username đã tồn tại';
        Action::run('errorEvent', $msg);
      }
    }

    // Update data
    $res = UserModel::update([
      'id' => $userCurrentData['id'],
    ], $data);

    [$msg, $status] = $res
      ? ['Updated', 'success']
      : ['Something went wrong', 'error'];

    Action::run('reverse', $msg, $status);
  }

}