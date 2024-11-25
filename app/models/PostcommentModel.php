<?php
class PostCommentModel extends BaseModel
{
  protected $table = 'post_comments_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'post_id' => 'postId',
    'comments_id' => 'commentsId',
    'created_at' => 'createdAt'
  ];
}
