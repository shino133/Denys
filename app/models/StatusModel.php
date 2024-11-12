<?php
class StatusModel extends BaseModel
{
  protected $table = 'status_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'createdAt' => 'createdAt'
  ];
}
