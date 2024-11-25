<?php
class MessageRoomModel extends BaseModel
{
  protected $table = 'message_rooms_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user1' => 'user1',
    'user2' => 'user2',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];
}
