<?php
class PostlikeModel extends BaseModel
{
  protected $table = 'post_likes_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'post_Id' => 'posId',
    'user_Id' => 'userId',
    'created_At' => 'createdAt'
  ];
}
