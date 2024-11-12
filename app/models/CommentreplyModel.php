<?php
class CommentreplyModel extends BaseModel
{
  protected $table = 'comment_replies_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'commentld' => 'commentld',
    'replyld' => 'replyld',
    'createdAt' => 'createdAt'
  ];
}
