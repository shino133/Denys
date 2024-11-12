<?php
class EventModel extends BaseModel
{
  protected $table = 'events_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'userld' => 'userld',
    'title' => 'title',
    'bannerUrl' => 'bannerUrl',
    'content' => 'content',
    'status' => 'status',
    'createdAt' => 'createdAt',
    'updatedAt' => 'updatedAt'
  ];
}
