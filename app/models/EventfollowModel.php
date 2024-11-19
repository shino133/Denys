<?php
class EventFollowModel extends BaseModel
{
  protected $table = 'event_follows_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'event_Id' => 'eventId',
    'user_Id' => 'userId',
    'created_At' => 'createdAt'
  ];
}
