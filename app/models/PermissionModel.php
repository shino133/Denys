<?php
class PermissionModel extends BaseModel
{
  public static $table = 'permissions_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'created_at' => 'createdAt'
  ];
}
