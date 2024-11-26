<?php
class UserFriendshipModel extends BaseModel
{
  public $table = 'user_friendship_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'user_id1' => 'userId1',
    'user_id2' => 'userId2',
    'created_at' => 'createdAt'
  ];
}
