<?php
namespace App\Features;

use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Services\UserService;

class AutoLogout
{

  public static function run(): bool
  {
    if (! Auth::checkUser()) {
      return false;
    }

    $timeCurrent = time();
    $timeLogin = Auth::getLoginTime();
    $timeOut = 1 * 60; // 1 minutes

    if ($timeCurrent - $timeLogin <= $timeOut) {
      return false;
    }

    $userCurrentData = UserController::getCurrentUserData();

    if (empty($userCurrentData) == false) {
      AppLoader::model('UserModel');
      Auth::setUser(UserService::validatePublicData($userCurrentData));
      Auth::setLoginTime();
      return false;
    }

    AuthController::redirectToLogin();
    return true;
  }
}






