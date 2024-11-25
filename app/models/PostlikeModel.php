<?php
class PostLikeModel extends BaseModel
{
  protected $table = 'post_likes_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'post_id' => 'posId',
    'user_id' => 'userId',
    'created_at' => 'createdAt'
  ];
}
