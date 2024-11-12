<?php
class PermissionModel extends BaseModel
{
  protected $table = 'permissions_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'key' => 'key',
    'description' => 'description',
    'createdAt' => 'createdAt'
  ];
}
