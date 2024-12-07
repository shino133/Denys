<?php
class AutoLogout
{

  public static function run(): bool
  {
    if (!Auth::checkUser()) {
      return false;
    }

    $timeCurrent = time();
    $timeLogin = Auth::getLoginTime();
    $timeOut = 1 * 60; // 1 minutes

    if ($timeCurrent - $timeLogin <= $timeOut) {
      return false;
    }

    AppLoader::controller('UserController');
    $userCurrentData = UserController::getCurrentUserData();
    
    if (empty($userCurrentData) == false) {
      AppLoader::model('UserModel');
      Auth::setUser(UserModel::validatePublicData($userCurrentData));
      Auth::setLoginTime();
      return false;
    }

    AppLoader::controller('AuthController');
    AuthController::redirectToLogin();
    return true;
  }
}






