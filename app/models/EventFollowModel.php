<?php
class EventFollowModel extends BaseModel
{
  public static $table = 'event_follows_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'event_id' => 'eventId',
    'user_id' => 'userId',
    'created_at' => 'createdAt'
  ];
}
