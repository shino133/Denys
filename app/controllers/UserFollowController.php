<?php
AppLoader::model('UserFollowModel');
AppLoader::model('UserModel');
AppLoader::util('ApiHandler');

class UserFollowController extends BaseController
{
  public static function getFollowersId($followerName): int|null
  {
    $follower = UserModel::find(conditions: [
      'userName' => $followerName
    ], columns: [
      'id' => 'id'
    ], limit: 1);

    if (empty($follower)) {
      return null;
    }

    return (int) $follower[0]['id'];
  }

  public static function findUserFollowId($userId, $followerId)
  {
    return UserFollowModel::find(conditions: [
      'userId' => $userId,
      'followerId' => $followerId
    ], columns: [
      'id' => 'id'
    ], limit: 1);
  }

  public static function followRequest($followerName)
  {
    $currentUserId = Auth::getUser('id');

    $isCurrentUser = $followerName == Auth::getUser('user_name');

    if ($isCurrentUser) {
      ApiHandler::sendError('Cannot follow yourself', 400);
      return;
    }

    $followerId = self::getFollowersId($followerName);

    if (empty($followerId)) {
      ApiHandler::sendError('Cannot find user', 404);
      return;
    }

    $isFollowing = self::findUserFollowId($currentUserId, $followerId);

    if (empty($isFollowing) == false) {
      ApiHandler::sendError('Following user already', 400);
      return;
    }

    $res = UserFollowModel::create([
      'userId' => $currentUserId,
      'followerId' => $followerId
    ]);

    if (empty($res)) {
      ApiHandler::sendError('Cannot follow user', 500);
      return;
    }

    ApiHandler::sendJson(['message' => 'Successfully followed user']);
  }
  public static function unfollowRequest($followerName)
  {
    $currentUserId = Auth::getUser('id');

    $followerId = self::getFollowersId($followerName);

    if (empty($followerId)) {
      ApiHandler::sendError('Cannot find user', 404);
      return;
    }

    $res = UserFollowModel::delete([
      'userId' => $currentUserId,
      'followerId' => $followerId
    ]);

    if ($res == false) {
      ApiHandler::sendError('Cannot unfollow user', 500);
      return;
    }

    ApiHandler::sendJson(['message' => 'Successfully unfollowed user']);
  }

  public static function checkFollowing($followerName): bool
  {
    $currentUserId = Auth::getUser('id');
    if (isset($followerName) == false) return false;

    $followerId = self::getFollowersId($followerName);

    if (empty($followerId)) return false;

    $isFollowing = self::findUserFollowId($currentUserId, $followerId);

    return empty($isFollowing) == false;
  }
      
}