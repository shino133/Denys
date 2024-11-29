<?php
class StatusModel extends BaseModel
{
  public static $table = 'status_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'created_at' => 'createdAt'
  ];
}
