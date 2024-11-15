
<?php
class UserfollowModel extends BaseModel
{
  protected $table = 'user_follows_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_Id' => 'userId',
    'follower_Id' => 'followerId',
    'created_At' => 'createdAt'
  ];
}
