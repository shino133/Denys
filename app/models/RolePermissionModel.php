<?php
class RolePermissionModel extends BaseModel
{
  public static $table = 'role_permissions_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'role_id' => 'roleId',
    'permission_id' => 'permissionId',
    'created_at' => 'createdAt'
  ];
}
