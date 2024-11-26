<?php
class EventFollowModel extends BaseModel
{
  public $table = 'event_follows_table'; // Đặt tên bảng
  public $columns = [
    'id' => 'id',
    'event_id' => 'eventId',
    'user_id' => 'userId',
    'created_at' => 'createdAt'
  ];
}
