<?php
AppLoader::model('UserModel');

class UserController extends BaseController
{
  private $model;
  public static function index()
  {
    $userData = UserModel::read(['*']);

    self::setData('username', $userData);

    self::render('User/main');
  }

  public static function profilePage($user_id = null)
  {
    Constants::profilePage();
    AppLoader::model('PostModel');

    $user_id ??= Auth::getUser()['id'];
    $profileData = self::getProfile($user_id);

    $postData = PostModel::getPosts(conditions: [
      'status' => 'active',
      'userId' => $user_id
    ]) ?: [];

    // dumpVar([
    //   'profileData' => $profileData,
    //   'postData' => $postData
    // ]);


    self::setAllData(data: [
      'profileData' => $profileData,
      'postData' => $postData,
    ]);

    self::render('User/Profile/main');
  }

  public static function profilePublicPage($username = null)
  {
    Action::set('reverse', function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      self::reverse(Url::getQueryString());
    });

    Action::set('errorEvent', function ($msg = 'Không tìm thấy người dùng') {
      Action::run('reverse', $msg, 'error');
    });

    if ($username == null) {
      return Action::run('errorEvent');
    }

    $userId = UserModel::find(conditions: [
      'userName' => $username
    ], columns: [
      'id' => 'id'
    ], limit: 1);

    if (empty($userId)) {
      return Action::run('errorEvent');
    }

    $user_id = $userId[0]['id'];

    self::profilePage($user_id);
  }

  public static function uploadAvatar()
  {
    Action::set('reverse', function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      self::reverse(Url::getQueryString());
    });

    AppLoader::controller('AssetController');
    $uploadImage = AssetController::upImage('avatar');

    if ($uploadImage['success'] == false) {
      return Action::run('reverse', $uploadImage['msg']);
    }

    $user_id = Auth::getUser()['id'];
    $fileName = $uploadImage['fileName'];

    $isUpdated = UserModel::update(conditions: [
      'id' => $user_id
    ], data: [
      'avatarUrl' => $fileName
    ]);

    [$msg, $status] = $isUpdated
      ? ['Updated', 'success']
      : ['Something went wrong', 'error'];

    $currentUserData = Auth::getUser();
    $currentUserData['avatar_url'] = $isUpdated == false ?: $fileName;

    Auth::setUser($currentUserData);

    Action::run('reverse', $msg, $status);
  }

  public static function uploadBanner()
  {
    Action::set('reverse', function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      self::reverse(Url::getQueryString());
    });

    AppLoader::controller('AssetController');
    $uploadImage = AssetController::upImage('banner');

    if ($uploadImage['success'] == false) {
      return Action::run('reverse', $uploadImage['msg']);
    }

    $user_id = Auth::getUser()['id'];
    $fileName = $uploadImage['fileName'];

    AppLoader::model('UserProfileModel');
    $isUpdated = UserProfileModel::update(conditions: [
      'userId' => $user_id
    ], data: [
      'bannerUrl' => $fileName
    ]);

    [$msg, $status] = $isUpdated
      ? ['Updated', 'success']
      : ['Something went wrong', 'error'];

    Action::run('reverse', $msg, $status);
  }
  public static function getProfile($user_id = null, $include_userData = true)
  {
    // dumpVar(Auth::getUser());

    // Set action
    $user_id ??= Auth::getUser()['id'];

    $ac = [
      'find' => 'findUserProfile',
      'createAndFind' => 'createUserProfile',
    ];

    AppLoader::model('UserProfileModel');
    // Find user profile
    Action::set($ac['find'], function ($profileId = null) use ($user_id, $include_userData) : array {
      $table = UserProfileModel::$table;
      $conditions = $profileId
        ? ["$table.id" => $profileId]
        : ["$table.userId" => $user_id];
      return $include_userData
        ? UserProfileModel::getProfile(
          userId: $user_id,
          conditions: $conditions,
          limit: 1
        )
        : UserProfileModel::find(
          conditions: $conditions,
          limit: 1,
          include_alias: true
        );
    });

    // Create user profile and Find again
    Action::set($ac['createAndFind'], function () use ($ac, $user_id) : array {
      $profileId = UserProfileModel::create(['userId' => $user_id]);
      return Action::run($ac['find'], $profileId);
    });

    // Get user profile
    $profileData = Action::run($ac['find']);
    if (empty($profileData)) {
      $profileData = Action::run($ac['createAndFind']);
    }

    $profileData = $profileData[0];

    $socialAccounts = $profileData['profile_socialAccounts'];
    if (isset($socialAccounts)) {
      $profileData['profile_socialAccounts'] = json_decode($socialAccounts, true);
    }

    return $profileData;
  }

  public static function getUserById($user_id = null, $conditions = ['status' => 'active'], $limit = 1) : array
  {
    if (isset($user_id) === false) {
      // Get current user from session
      AppLoader::controller('AuthController');
      $userCurrentData = AuthController::getCurrentUserData();
      $user_id = $userCurrentData['id'];
    }

    // dumpVar(Auth::getUser()); 

    $conditions['id'] = $user_id;
    return UserModel::find(conditions: $conditions, limit: $limit);
  }

  public static function getCurrentUserData($conditions = ['status' => 'active']) : array
  {
    return self::getUserById(conditions: $conditions, limit: 1)[0] ?? [];
  }
}
