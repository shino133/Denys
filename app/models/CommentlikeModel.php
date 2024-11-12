<?php
class CommentlikeModel extends BaseModel
{
  protected $table = 'comment_likes_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'commentld' => 'commentld',
    'userld' => 'userld',
    'createdAt' => 'createAt'
  ];
}
