<?php
namespace App\Models;

use App\Features\Auth;
use App\Utils\TimeHelper;

class PostModel extends Model
{
  public static $table = 'posts_table'; // Đặt tên bảng
  public static $alias = 'post';
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'title' => 'title',
    'content' => 'content',
    'media_type' => 'mediaType',
    'media_url' => 'mediaUrl',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];
}

