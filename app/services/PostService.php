<?php
namespace App\Services;

use App\Features\Auth;
use App\Models\PostCommentModel;
use App\Models\PostLikeModel;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Utils\TimeHelper;

class PostService extends Service
{
  public static function addPost($data)
  {
    return PostModel::create([
      'userId' => $data['user_id'],
      'title' => $data['title'] ?? '',
      'content' => $data['content'],
      'mediaType' => $data['media_type'],
      'mediaUrl' => $data['media_url'],
    ]);
  }

  public static function getPosts(
    string|null $orderBy = 'created_at',
    array $conditions = ['status' => 'active'],
    int $limit = 10,
    int $offset = 0
  ): array|bool {

    $postCommentTable = PostCommentModel::$table;
    $postLikeTable = PostLikeModel::$table;
    $userTable = UserModel::$table;
    $userAlias = UserModel::$alias;

    $userColumns = PostModel::aliasColumns(columns: UserModel::$columns,
      table: $userTable, alias: $userAlias, overrides: [
        'userName' => 'user_userName',
        'fullName' => 'user_fullName',
        'avatarUrl' => 'user_avatarUrl',
      ]);

    $postColumns = PostModel::aliasColumns(columns: PostModel::$columns,
      table: PostModel::$table, alias: PostModel::$alias, overrides: [
        'id' => 'post_id',
        'content' => 'post_content',
        'mediaType' => 'post_mediaType',
        'mediaUrl' => 'post_mediaUrl',
        'status' => 'post_status',
        'createdAt' => 'post_createdAt',
        'updatedAt' => 'post_updatedAt',
        'userId' => 'user_userId',
      ]);

    // Thêm cột bổ sung
    $extraColumns = [
      "COUNT(DISTINCT $postCommentTable.id) AS commentCount",
      "COUNT(DISTINCT $postLikeTable.postId) AS likeCount",
    ];

    // Xác định người dùng hiện tại
    $currentUserId = Auth::getUser()['id'] ?? null;
    if ($currentUserId) {
      $extraColumns[] = "MAX($postLikeTable.userId = $currentUserId) AS isLikedByCurrentUser";
    }

    // Gộp tất cả các cột
    $columns = array_merge($postColumns, $userColumns, $extraColumns);

    // Cấu hình join
    $joins = [
      [
        'type' => 'INNER',
        'table' => $userTable,
        'on' => "$userTable.id = ".PostModel::$table.".userId"
      ],
      [
        'type' => 'LEFT',
        'table' => $postCommentTable,
        'on' => "$postCommentTable.postId = ".PostModel::$table.".id"
      ],
      [
        'type' => 'LEFT',
        'table' => $postLikeTable,
        'on' => "$postLikeTable.postId = ".PostModel::$table.".id"
      ]
    ];

    // Xử lý điều kiện
    $conditionsValid = PostModel::prefixConditions($conditions, PostModel::$table);

    // Xử lý orderBy
    $orderBy = $orderBy
      ? PostModel::$table.'.'.PostModel::$columns[$orderBy].' DESC'
      : null;

    // Truy vấn
    $data = PostModel::join(
      joins: $joins,
      columns: $columns,
      conditions: $conditionsValid,
      orderBy: $orderBy,
      limit: $limit,
      offset: $offset,
      groupBy: PostModel::$table.'.id'
    );

    if (! $data) {
      return false;
    }

    // Thêm cột `timeAgo`
    foreach ($data as $key => $post) {
      $data[$key]['timeAgo'] = TimeHelper::timeAgo($post['post_createdAt']);
    }

    return $data;
  } 
}