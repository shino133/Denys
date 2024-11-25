<?php
class CommentLikeModel extends BaseModel
{
  protected $table = 'comment_likes_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'comment_id' => 'commentId',
    'user_id' => 'userId',
    'created_at' => 'createAt'
  ];
}
