<?php
class SettingController extends AdminBaseController
{
  public static function index()
  {
    self::redirect('/admin/settings/password');
  }

  public static function passwordPage()
  {
    ConstantsAdmin::homePage();
    self::renderAdmin('Setting/Password/main');
  }


  public static function passwordPageRequest()
  {
    AppLoader::lib('hashPass');
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
      'password' => $_POST['password'] ?? null,
      'newPassword' => $_POST['newPassword'] ?? null,
      'confirmNewPassword' => $_POST['confirmNewPassword'] ?? null,
    ];

    // Validate
    Action::runAuto(function () use ($postData) {
      // Check null or empty data
      if (DataValidator::check($postData) == false) {
        $msg = 'Vui lòng nhập đầy đủ dữ liệu';
        Action::run('errorEvent', $msg);
      }

      // Check password valid
      foreach ($postData as $key => $value) {
        if (AuthController::validPassword($value) == false) {
          $msg = 'Password phải có ít nhất 8 ký tự, 1 chữ thường, 1 chữ hoa, 1 số, 1 ký tự đặc biệt';
          Action::run('errorEvent', $msg);
        }
      }

      // Check password confirm
      if ($postData['newPassword'] !== $postData['confirmNewPassword']) {
        $msg = 'Mật khẩu nhâp lại không khớp';
        Action::run('errorEvent', $msg);
      }
    });

    // Get current user
    AppLoader::controller('UserController');
    $userCurrentData = UserController::getCurrentUserData();
    if (empty($userCurrentData)) {
      $msg = 'Không thể lấy dữ liệu người dùng';
      Action::run('errorEvent', $msg);
    }

    // Check password
    $userCurrentPassword = decryptData($userCurrentData['password']);
    if ($userCurrentPassword !== $postData['password']) {
      $msg = 'Mật khẩu không chính xác';
      Action::run('errorEvent', $msg);
    }

    // Password encryption
    $newPassword = hashPass($postData['newPassword']);

    // Update password
    $res = UserModel::update(
      conditions: [
        'id' => Auth::getUser()['id']
      ], data: [
        'password' => $newPassword
      ]
    );

    [$msg, $status] = $res
      ? ['Updated', 'success']
      : ['Something went wrong', 'error'];

    Action::run('reverse', $msg, $status);
  }
}