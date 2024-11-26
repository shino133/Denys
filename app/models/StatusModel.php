<?php
class StatusModel extends BaseModel
{
  public $table = 'status_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'created_at' => 'createdAt'
  ];
}
