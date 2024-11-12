<?php
class EventfollowModel extends BaseModel
{
  protected $table = 'event_follows_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'eventld' => 'eventld',
    'userld' => 'userld',
    'createdAt' => 'createdAt'
  ];
}
