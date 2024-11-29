<?php
class MediaTypeModel extends BaseModel
{
  public static $table = 'media_type_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'created_at' => 'createdAt'
  ];
}
