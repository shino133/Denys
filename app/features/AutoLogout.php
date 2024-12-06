<?php
class AutoLogout
{

  public static function run()
  {
    if (!Auth::checkUser()) {
      return;
    }

    $timeCurrent = time();
    $timeLogin = Auth::getLoginTime();
    $timeOut = 1 * 60; // 1 minutes

    if ($timeCurrent - $timeLogin <= $timeOut) {
      return;
    }

    AppLoader::controller('UserController');
    AppLoader::model('UserModel');
    $userCurrentData = UserController::getCurrentUserData();

    if (empty($userCurrentData)) {
      Auth::logout();
      return;
    }

    Auth::setUser(UserModel::validatePublicData($userCurrentData));
    Auth::setLoginTime();
  }
}






