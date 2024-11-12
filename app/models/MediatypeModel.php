<?php
class MediatypeModel extends BaseModel
{
  protected $table = 'media_type_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'createdAt' => 'createdAt'
  ];
}
