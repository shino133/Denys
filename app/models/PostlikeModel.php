<?php
class PostLikeModel extends BaseModel
{
  public static $table = 'post_likes_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'post_id' => 'posId',
    'user_id' => 'userId',
    'created_at' => 'createdAt'
  ];
}
