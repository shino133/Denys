<?php
class MessageroomModel extends BaseModel
{
  protected $table = 'message_rooms_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user1' => 'user1',
    'user2' => 'user2',
    'status' => 'status',
    'createdAt' => 'createdAt',
    'updatedAt' => 'updatedAt'
  ];
}
