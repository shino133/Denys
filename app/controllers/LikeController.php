<?php
AppLoader::model('PostLikeModel');
AppLoader::util('ApiHandler');

class LikeController extends BaseController
{
  public static function addLike($postId)
  {
    Action::set('apiResponse', function ($res) {
      $res == false
        ? ApiHandler::sendError('Failed', 500)
        : ApiHandler::sendJson(['message' => 'Successfully']);
    });

    $res = PostLikeModel::find([
      'postId' => $postId,
      'userId' => Auth::getUser('id'),
    ]);

    if (empty($res) == false) {
      Action::run('apiResponse', false);
    }

    $res = PostLikeModel::create([
      'postId' => $postId,
      'userId' => Auth::getUser('id'),
    ]);

    Action::run('apiResponse', $res);
  }

  public static function destroyLike($postId)
  {
    $res = PostLikeModel::delete([
      'postId' => $postId,
      'userId' => Auth::getUser('id'),
    ]);
    
    $res == false
      ? ApiHandler::sendError('Failed to unlike post', 500)
      : ApiHandler::sendJson(['message' => 'Unlike post successfully']);
  }

}