<?php
class MessageRoomModel extends BaseModel
{
  public static $table = 'message_rooms_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'user1' => 'user1',
    'user2' => 'user2',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];
}
