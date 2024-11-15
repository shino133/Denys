<?php
class CommentLikeModel extends BaseModel
{
  protected $table = 'comment_likes_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'comment_Id' => 'commentId',
    'user_Id' => 'userId',
    'created_At' => 'createAt'
  ];
}
