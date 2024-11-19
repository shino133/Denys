<?php
class PostModel extends BaseModel
{
  protected $table = 'posts_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_Id' => 'userId',
    'title' => 'title',
    'content' => 'content',
    'media_Type' => 'mediaType',
    'media_Url' => 'mediaUrl',
    'status' => 'status',
    'created_At' => 'createdAt',
    'updated_At' => 'updatedAt'
  ];
}
