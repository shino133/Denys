<?php
class RoleModel extends BaseModel
{
  public static $table = 'roles_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'created_at' => 'createdAt'
  ];
}
