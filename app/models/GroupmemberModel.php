<?php
class GroupMemberModel extends BaseModel
{
  protected $table = 'group_members_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'group_id' => 'groupId',
    'user_id' => 'userId',
    'created_at' => 'createdAt'
  ];
}
