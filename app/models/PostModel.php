<?php
class PostModel extends BaseModel
{
  public static $table = 'posts_table'; // Đặt tên bảng
  public static $alias = 'post';
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
      'title' => $data['title'] ?? '',
      'content' => $data['content'],
      'mediaType' => $data['media_type'],
      'mediaUrl' => $data['media_url'],
    ];
    return self::create($postData);
  }

  public static function getPosts(
    string|null $orderBy = 'created_at',
    array $conditions = ['status' => 'active'],
    int $limit = 10,
    int $offset = 0
  ) : array|bool {
    // Lấy thông tin bảng
    AppLoader::model('UserModel');
    AppLoader::model('PostCommentModel');
    AppLoader::model('PostLikeModel');

    $postCommentTable = PostCommentModel::$table;
    $postLikeTable = PostLikeModel::$table;
    $userTable = UserModel::$table;
    $userAlias = UserModel::$alias;

    $userColumns = self::aliasColumns(columns: UserModel::$columns,
      table: $userTable, alias: $userAlias, overrides: [
        'userName' => 'user_userName',
        'fullName' => 'user_fullName',
        'avatarUrl' => 'user_avatarUrl',
      ]);

    $postColumns = self::aliasColumns(columns: self::$columns,
      table: self::$table, alias: self::$alias, overrides: [
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

    // Xử lý điều kiện
    $conditionsValid = self::prefixConditions($conditions, self::$table);

    // Xử lý orderBy
    $orderBy = $orderBy
      ? self::$table . '.' . self::$columns[$orderBy] . ' DESC'
      : null;

    // Truy vấn
    $data = self::join(
      joins: $joins,
      columns: $columns,
      conditions: $conditionsValid,
      orderBy: $orderBy,
      limit: $limit,
      offset: $offset,
      groupBy: self::$table . '.id'
    );

    if (! $data) {
      return false;
    }

    // Thêm cột `timeAgo`
    AppLoader::util('TimeHelper');
    foreach ($data as $key => $post) {
      $data[$key]['timeAgo'] = TimeHelper::timeAgo($post['post_createdAt']);
    }

    return $data;
  }
}

