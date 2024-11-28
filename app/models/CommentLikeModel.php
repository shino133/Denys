<?php
class CommentLikeModel extends BaseModel
{
  public static $table = 'comment_likes_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'comment_id' => 'commentId',
    'user_id' => 'userId',
    'created_at' => 'createAt'
  ];
}
