<?php
class GroupMemberModel extends BaseModel
{
  public $table = 'group_members_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'group_id' => 'groupId',
    'user_id' => 'userId',
    'created_at' => 'createdAt'
  ];
}
