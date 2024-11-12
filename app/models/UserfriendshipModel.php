<?php
class UserfriendshipModel extends BaseModel
{
  protected $table = 'user_friendship_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'userld1' => 'userld1',
    'userld2' => 'userld2',
    'createdAt' => 'createdAt'
  ];
}
