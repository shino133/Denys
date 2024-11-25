<?php
class UserPermissionModel extends BaseModel
{
  protected $table = 'user_permissions_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_id' => 'userId',
    'permission_id' => 'permissionId',
    'created_at' => 'createdAt'
  ];
}
