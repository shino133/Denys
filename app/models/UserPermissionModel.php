<?php
class UserPermissionModel extends BaseModel
{
  public $table = 'user_permissions_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'permission_id' => 'permissionId',
    'created_at' => 'createdAt'
  ];
}
