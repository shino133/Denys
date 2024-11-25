<?php
class CommentReplyModel extends BaseModel
{
  protected $table = 'comment_replies_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'comment_id' => 'commentId',
    'reply_id' => 'replyId',
    'created_at' => 'createdAt'
  ];
}
