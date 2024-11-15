<?php
class CommenTreplyModel extends BaseModel
{
  protected $table = 'comment_replies_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'comment_Id' => 'commentId',
    'reply_Id' => 'replyId',
    'created_At' => 'createdAt'
  ];
}
