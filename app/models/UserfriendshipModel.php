<?php
class UserFriendshipModel extends BaseModel
{
  protected $table = 'user_friendship_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_id1' => 'userId1',
    'user_id2' => 'userId2',
    'created_at' => 'createdAt'
  ];
}
