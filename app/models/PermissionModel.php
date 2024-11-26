<?php
class PermissionModel extends BaseModel
{
  public $table = 'permissions_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'created_at' => 'createdAt'
  ];
}
