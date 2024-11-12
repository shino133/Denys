<?php
class RoleModel extends BaseModel
{
  protected $table = 'roles_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'createdAt' => 'createdAt'
  ];
}
