<?php
class MessageModel extends BaseModel
{
  protected $table = 'messages_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'sender_id' => 'senderId',
    'room_id' => 'roomId',
    'content' => 'content',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt',
    'media_type' => 'mediaType',
    'media_url' => 'mediaUrl'
  ];
}
