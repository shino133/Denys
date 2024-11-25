<?php
class EventModel extends BaseModel
{
  protected $table = 'events_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_id' => 'userId',
    'title' => 'title',
    'banner_url' => 'bannerUrl',
    'content' => 'content',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];
}
