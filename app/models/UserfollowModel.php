
<?php
class UserFollowModel extends BaseModel
{
  protected $table = 'user_follows_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_id' => 'userId',
    'follower_id' => 'followerId',
    'created_at' => 'createdAt'
  ];
}
