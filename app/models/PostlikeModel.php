<?php
class PostlikeModel extends BaseModel
{
  protected $table = 'post_likes_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'postld' => 'postld',
    'userld' => 'userld',
    'createdAt' => 'createdAt'
  ];
}
