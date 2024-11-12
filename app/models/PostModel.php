<?php
class PostModel extends BaseModel
{
  protected $table = 'posts_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'userld' => 'userld',
    'title' => 'title',
    'content' => 'content',
    'mediaType' => 'mediaType',
    'mediaUrl' => 'mediaUrl',
    'status' => 'status',
    'createdAt' => 'createdAt',
    'updatedAt' => 'updatedAt'
  ];
}
