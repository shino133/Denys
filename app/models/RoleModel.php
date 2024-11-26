<?php
class RoleModel extends BaseModel
{
  public $table = 'roles_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'created_at' => 'createdAt'
  ];
}
