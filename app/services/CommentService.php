<?php
namespace App\Services;

use App\Models\CommentModel;
use App\Utils\TimeHelper;

class CommentService extends Service
{
  public static function addComment($data)
  {
    return CommentModel::create([
      'userId' => $data['user_id'],
      'content' => $data['content'],
      'mediaType' => $data['media_type'],
      'mediaUrl' => $data['media_url'],
    ]);
  }

  public static function getCommentByPostId($postId, $orderBy = 'createdAt', $limit = null): array
  {
    $userTable = "users_table";
    $commentTable = "comments_table";
    $postCommentTable = "post_comments_table";

    $joins = [
      [
        'type' => 'INNER',
        'table' => $userTable,
        'on' => "$userTable.id = $commentTable.userId"
      ],
      [
        'type' => 'LEFT',
        'table' => $postCommentTable,
        'on' => "$postCommentTable.commentsId = $commentTable.id"
      ]
    ];

    $columns = [
      "$commentTable.id as comment_id",
      "$commentTable.content as comment_content",
      "$commentTable.mediaType as comment_mediaType",
      "$commentTable.mediaUrl as comment_mediaUrl",
      "$commentTable.userId as user_userId",
      "$userTable.userName as user_userName",
      "$userTable.fullName as user_fullName",
      "$userTable.avatarUrl as user_avatarUrl",
      // "$postCommentTable.id as postComment_id",
      // "$postCommentTable.postId as postComment_postId",
      "$postCommentTable.createdAt as postComment_createdAt",
    ];

    $conditions = [
      "$postCommentTable.postId" => $postId
    ];

    if ($orderBy) {
      $orderBy = "$postCommentTable.$orderBy DESC";
    }

    $comments = CommentModel::join($joins, $columns, $conditions, $orderBy, $limit);

    if (! isset($comments) || $comments === false) {
      return [];
    }

    foreach ($comments as $key => $comment) {
      $comments[$key]['timeAgo'] = TimeHelper::timeAgo($comment['postComment_createdAt']);
    }

    return $comments;
  }
}