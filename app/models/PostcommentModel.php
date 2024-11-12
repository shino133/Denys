<?php
class PostcommentModel extends BaseModel
{
  protected $table = 'post_comments_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'postld' => 'postld',
    'commentsld' => 'commentsld',
    'createdAt' => 'createdAt'
  ];
}
