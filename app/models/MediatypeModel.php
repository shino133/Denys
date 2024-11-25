<?php
class MediaTypeModel extends BaseModel
{
  protected $table = 'media_type_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'created_at' => 'createdAt'
  ];
}
