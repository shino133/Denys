<?php
class PostModel extends BaseModel
{
  public $table = 'posts_table'; // Đặt tên bảng
  public $columns = [
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

  public function addPost($data)
  {
    $postData = [
      'userId' => $data['user_id'],
      'title' => $data['title'],
      'content' => $data['content'],
      'mediaType' => $data['media_type'],
      'mediaUrl' => $data['media_url'],
    ];
    return $this->create($postData);
  }

  public function getPosts($orderBy = 'created_at', $conditions = ['status' => "active"], $limit = 10)
  {
    $user = "users_table";
    $post = "posts_table";

    $joins = [
      [
        'type' => 'INNER',
        'table' => $user,
        'on' => "$user.id = $post.userId"
      ],
    ];

    $columns = ["$post.*", "$user.fullName as user_fullName", "$user.avatarUrl as user_avatarUrl"];

    $conditionsValid = [];
    foreach ($conditions as $field => $value) {
      $conditionsValid["$post.$field"] = $value;
    }

    $orderBy = "$post." . $this->columns[$orderBy] . " DESC";

    return $this->join($joins, $columns, $conditionsValid, $orderBy, $limit);
  }
}
