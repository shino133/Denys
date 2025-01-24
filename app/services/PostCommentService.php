<?php
namespace App\Services;

use App\Models\PostCommentModel;

class PostCommentService extends Service
{
  public static function addPostComment($data)
  {
    return PostCommentModel::create([
      'postId' => $data['post_id'],
      'commentsId' => $data['comment_id']
    ]);
  }
}