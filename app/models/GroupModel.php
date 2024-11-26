<?php
class GroupModel extends BaseModel
{
  public $table = 'groups_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'name' => 'name',
    'banner_url' => 'bannerUrl',
    'bio' => 'bio',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];
}
