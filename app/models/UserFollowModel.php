<?php
namespace App\Models;

class UserFollowModel extends Model
{
  public static $table = 'user_follows_table'; // Đặt tên bảng
  public static $alias = 'user_follow';
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'follower_id' => 'followerId',
    'created_at' => 'createdAt'
  ];
}
