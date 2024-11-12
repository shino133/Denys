<?php
class GroupmemberModel extends BaseModel
{
  protected $table = 'group_members_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'groupld' => 'groupld',
    'userld' => 'userld',
    'createdAt' => 'createdAt'
  ];
}
