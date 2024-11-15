<?php
class PostcommentModel extends BaseModel
{
  protected $table = 'post_comments_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'post_Id' => 'postId',
    'comments_Id' => 'commentsId',
    'created_At' => 'createdAt'
  ];
}
