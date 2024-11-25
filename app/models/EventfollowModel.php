<?php
class EventFollowModel extends BaseModel
{
  protected $table = 'event_follows_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'event_id' => 'eventId',
    'user_id' => 'userId',
    'created_at' => 'createdAt'
  ];
}
