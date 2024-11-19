<?php
class RolepermissionModel extends BaseModel
{
  protected $table = 'role_permissions_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'role_Id' => 'roleId',
    'permission_Id' => 'permissionId',
    'created_At' => 'createdAt'
  ];
}
