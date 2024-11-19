<?php
class GroupmemberModel extends BaseModel
{
  protected $table = 'group_members_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'group_Id' => 'groupId',
    'user_Id' => 'userId',
    'created_At' => 'createdAt'
  ];
}
