<?php
class PostModel extends BaseModel
{
  protected $table = 'posts_table'; // Đặt tên bảng
  protected $column = [
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

  public function addPost($data) {
    $postData = [
      'userId' => $data['user_id'],
      'title' => $data['title'],
      'content' => $data['content'],
      'mediaType' => $data['media_type'],
      'mediaUrl' => $data['media_url'],
    ];
    return $this->create($postData);
  }

  public function getNewestPost() {
    $sql = "SELECT * FROM {$this->table} ORDER BY {$this->column['created_at']} DESC LIMIT 1";
    return $this->query($sql);
  }
}
