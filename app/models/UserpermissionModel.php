<?php
class UserpermissionModel extends BaseModel
{
  protected $table = 'user_permissions_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_Id' => 'userId',
    'permission_Id' => 'permissionId',
    'created_At' => 'createdAt'
  ];
}
