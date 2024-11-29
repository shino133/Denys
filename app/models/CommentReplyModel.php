<?php
class CommentReplyModel extends BaseModel
{
  public static $table = 'comment_replies_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'comment_id' => 'commentId',
    'reply_id' => 'replyId',
    'created_at' => 'createdAt'
  ];
}
