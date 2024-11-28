<?php
class PostCommentModel extends BaseModel
{
  public static $table = 'post_comments_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'post_id' => 'postId',
    'comments_id' => 'commentsId',
    'created_at' => 'createdAt'
  ];

  public static function addPostComment($data)
  {
    return self::create([
      'postId' => $data['post_id'],
      'commentsId' => $data['comments_id']
    ]);
  }
}
