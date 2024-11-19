<?php
class GroupModel extends BaseModel
{
  protected $table = 'groups_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_Id' => 'userId',
    'name' => 'name',
    'banner_Url' => 'bannerUrl',
    'bio' => 'bio',
    'status' => 'status',
    'created_At' => 'createdAt',
    'updated_At' => 'updatedAt'
  ];
}
