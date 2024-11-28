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

  public static function getProfile($user_id = null)
  {
    AppLoader::model('UserProfileModel');

    // Set action
    $user_id ??= Auth::getUser()['id'];
    $ac = [
      'find' => 'findUserProfile',
      'createAndFind' => 'createUserProfile',
    ];

    // Find user profile
    Action::set($ac['find'], function () use ($user_id): array {
      return UserProfileModel::find(
        conditions: ['userId' => $user_id],
        columns: ['*'],
        limit: 1
      );
    });

    // Create user profile and Find again
    Action::set($ac['createAndFind'], function () use ($ac, $user_id): array {
      UserProfileModel::create(['userId' => $user_id]);
      return Action::run($ac['find'], $user_id);
    });

    // Get user profile
    $userProfileData = Action::run($ac['find']) ?? Action::run($ac['createAndFind']);

    dumpVar($userProfileData);
  }
}
