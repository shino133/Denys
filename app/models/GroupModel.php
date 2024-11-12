<?php
class GroupModel extends BaseModel
{
  protected $table = 'groups_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'userld' => 'userld',
    'name' => 'name',
    'bannerUrl' => 'bannerUrl',
    'bio' => 'bio',
    'status' => 'status',
    'createdAt' => 'createdAt',
    'updatedAt' => 'updatedAt'
  ];
}
