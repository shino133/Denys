
<?php
class UserFollowModel extends BaseModel
{
  public $table = 'user_follows_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'follower_id' => 'followerId',
    'created_at' => 'createdAt'
  ];
}
