<?php
namespace App\Models;

class PostCommentModel extends Model
{
  public static $table = 'post_comments_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'post_id' => 'postId',
    'comments_id' => 'commentsId',
    'created_at' => 'createdAt'
  ];
}
