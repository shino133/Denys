<?php
class CommentModel extends BaseModel
{
  public static $table = 'comments_table'; // Đặt tên bảng
  public static $alias = 'comment';
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'content' => 'content',
    'media_type' => 'mediaType',
    'media_url' => 'mediaUrl',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];

  public static function addComment($data)
  {
    return self::create([
      'userId' => $data['user_id'],
      'content' => $data['content'],
      'mediaType' => $data['media_type'],
      'mediaUrl' => $data['media_url'],
    ]);
  }
}
