<?php
class MediaTypeModel extends BaseModel
{
  public $table = 'media_type_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'created_at' => 'createdAt'
  ];
}
