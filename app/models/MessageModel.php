<?php
class MessageModel extends BaseModel
{
  protected $table = 'messages_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'senderld' => 'senderld',
    'roomld' => 'roomld',
    'content' => 'content',
    'status' => 'status',
    'createdAt' => 'createdAt',
    'updatedAt' => 'updatedAt'
  ];
}
