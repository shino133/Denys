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
    AppLoader::controller('UserProfileController');

    $profileData = UserProfileController::getProfile(
      user_id: Auth::getUser()['id'],
      include_userData: false
    );

    // dumpVar($profileData);

    self::setAllData(data: [
      'profileData' => $profileData
    ]);

    self::render('Setting/Contact/main');
  }

  public static function passwordPage()
  {
    Constants::settingPage();
    self::render('Setting/Password/main');
  }

  public static function contactPageRequest()
  {
    AppLoader::model('UserProfileModel');
    Action::set('reverse', function ($msg = 'Something went wrong', $status = 'error') {
      Url::setNofi(msg: $msg, status: $status);
      self::reverse(Url::getQueryString());
    });

    $postData = [
      'location' => $_POST['location'] ?? null,
      'website' => $_POST['website'] ?? null,
      // 'socialAccounts' => $_POST['socialAccounts'] ?? null,
      'bio' => $_POST['bio'] ?? null,
    ];

    $postSocialAccounts = [
      'facebook' => $_POST['facebook'] ?? null,
      'instagram' => $_POST['instagram'] ?? null,
      'tiktok' => $_POST['tiktok'] ?? null,
    ];

    AppLoader::lib('isValidUrl');
    foreach ($postSocialAccounts as $platform => $account) {
      if (isValidUrl($account) == false) {
        unset($postSocialAccounts[$platform]);
      }
    }

    $postData['socialAccounts'] = json_encode($postSocialAccounts);

    $res = UserProfileModel::update(
      conditions: [
        'userId' => Auth::getUser()['id']
      ], data: $postData
    );

    [$msg, $status] = $res
      ? ['Updated', 'success']
      : ['Something went wrong', 'error'];

    Action::run('reverse', $msg, $status);
  }

  public static function accountPageRequest()
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
      'fullName' => $_POST['fullName'] ?? null,
      'email' => $_POST['email'] ?? null,
      'userName' => $_POST['userName'] ?? null,
      'password' => $_POST['password'] ?? null,
    ];

    // Validate
    Action::runAuto(function () use ($postData) {
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
    });

    // Get current user
    AppLoader::controller('UserController');
    $userCurrentData = UserController::getCurrentUserData();
    if (empty($userCurrentData)) {
      $msg = 'Không thể lấy dữ liệu người dùng';
      Action::run('errorEvent', $msg);
    }

    // Check password
    $passwordCorrect = checkPass(
      password: $postData['password'],
      hash: $userCurrentData['password']
    );

    if ($passwordCorrect == false) {
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
    $userCurrentPassword = $userCurrentData['password'];
    if (checkPass($postData['password'], $userCurrentPassword) == false) {
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