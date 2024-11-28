<?php
class PostModel extends BaseModel
{
  public static $table = 'posts_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'title' => 'title',
    'content' => 'content',
    'media_type' => 'mediaType',
    'media_url' => 'mediaUrl',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];

  public static function addPost($data)
  {
    $postData = [
      'userId' => $data['user_id'],
      'title' => $data['title'],
      'content' => $data['content'],
      'mediaType' => $data['media_type'],
      'mediaUrl' => $data['media_url'],
    ];
    return self::create($postData);
  }

  public static function getPosts($orderBy = 'created_at', $conditions = ['status' => "active"], $limit = 10): array|bool
  {
    $userTable = "users_table";
    $postCommentTable = "post_comments_table";
    $postLikeTable = "post_likes_table";

    $joins = [
      [
        'type' => 'INNER',
        'table' => $userTable,
        'on' => "$userTable.id = " . self::$table . ".userId"
      ],
      [
        'type' => 'LEFT',
        'table' => $postCommentTable,
        'on' => "$postCommentTable.postId = " . self::$table . ".id"
      ],
      [
        'type' => 'LEFT',
        'table' => $postLikeTable,
        'on' => "$postLikeTable.postId = " . self::$table . ".id"
      ]
    ];

    $columns = [
      self::$table . ".id as post_id",
      self::$table . ".content as post_content",
      self::$table . ".mediaType as post_mediaType",
      self::$table . ".mediaUrl as post_mediaUrl",
      self::$table . ".createdAt as post_createdAt",
      self::$table . ".userId as user_userId",
      "$userTable.userName as user_userName",
      "$userTable.fullName as user_fullName",
      "$userTable.avatarUrl as user_avatarUrl",
      "COUNT(DISTINCT $postCommentTable.id) as commentCount",
      "COUNT(DISTINCT $postLikeTable.postId) as likeCount",
    ];

    $currentUserId = Auth::getUser()['id'];
    if ($currentUserId) {
      $columns[] = "MAX($postLikeTable.userId = $currentUserId) as isLikedByCurrentUser";
    }

    $conditionsValid = [];
    foreach ($conditions as $field => $value) {
      $conditionsValid["" . self::$table . ".$field"] = $value;
    }

    if ($orderBy) {
      $orderBy = "" . self::$table . "." . self::$columns[$orderBy] . " DESC";
    }

    $groupBy = "" . self::$table . ".id";

    $posts = self::join($joins, $columns, $conditionsValid, $orderBy, $limit, null, $groupBy);

    if (!isset($posts) || $posts == false) {
      return false;
    }

    AppLoader::util('TimeHelper');
    foreach ($posts as $key => $post) {
      $posts[$key]['timeAgo'] = TimeHelper::timeAgo($post['post_createdAt']);
    }

    return $posts;
  }
}
