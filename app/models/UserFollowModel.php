
<?php
class UserFollowModel extends BaseModel
{
  public static $table = 'user_follows_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'follower_id' => 'followerId',
    'created_at' => 'createdAt'
  ];
}
