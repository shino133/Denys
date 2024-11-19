<?php
class UserfriendshipModel extends BaseModel
{
  protected $table = 'user_friendship_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_Id1' => 'userId1',
    'user_Id2' => 'userId2',
    'created_At' => 'createdAt'
  ];
}
