<?php
class MessageModel extends BaseModel
{
  protected $table = 'messages_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'sender_Id' => 'senderId',
    'room_Id' => 'roomId',
    'content' => 'content',
    'status' => 'status',
    'created_At' => 'createdAt',
    'updated_At' => 'updatedAt',
    'media_Type' => 'mediaType',
    'media_Url' => 'mediaUrl'
  ];
}
