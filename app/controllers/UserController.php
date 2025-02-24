<?php
namespace App\Controllers;

use App\Models\UserModel;

class UserController extends Controller
{
  public static function index()
  {
    $userData = UserModel::read(['*']);

    self::setData('username', $userData);

    self::render('User/main');
  }


  public static function getUserById($user_id = null, $conditions = ['status' => 'active'], $limit = 1) : array
  {
    if (isset($user_id) === false) {
      // Get current user from session
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
