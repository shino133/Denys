<?php
class CommentLikeModel extends BaseModel
{
  public $table = 'comment_likes_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'comment_id' => 'commentId',
    'user_id' => 'userId',
    'created_at' => 'createAt'
  ];
}
