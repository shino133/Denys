<?php
namespace App\Models;

class CommentModel extends Model
{
  public static $table = 'comments_table'; // Đặt tên bảng
  public static $alias = 'comment';
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'content' => 'content',
    'media_type' => 'mediaType',
    'media_url' => 'mediaUrl',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];
}
