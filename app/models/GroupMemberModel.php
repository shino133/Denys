<?php
class GroupMemberModel extends BaseModel
{
  public static $table = 'group_members_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'group_id' => 'groupId',
    'user_id' => 'userId',
    'created_at' => 'createdAt'
  ];
}
