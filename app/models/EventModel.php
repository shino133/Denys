<?php
class EventModel extends BaseModel
{
  public $table = 'events_table'; // Đặt tên bảng
  public $columns = [
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
