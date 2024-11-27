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
}
