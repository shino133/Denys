<?php
class RolePermissionModel extends BaseModel
{
  protected $table = 'role_permissions_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'role_id' => 'roleId',
    'permission_id' => 'permissionId',
    'created_at' => 'createdAt'
  ];
}
