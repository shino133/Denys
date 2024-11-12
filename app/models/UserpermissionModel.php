<?php
class UserpermissionModel extends BaseModel
{
  protected $table = 'user_permissions_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'userld' => 'userld',
    'permissionld' => 'permissionld',
    'createdAt' => 'createdAt'
  ];
}
