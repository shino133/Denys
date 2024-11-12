<?php
class RolepermissionModel extends BaseModel
{
  protected $table = 'role_permissions_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'roleld' => 'roleld',
    'permissionld' => 'permissionld',
    'createdAt' => 'createdAt'
  ];
}
