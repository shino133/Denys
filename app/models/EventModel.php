<?php
class EventModel extends BaseModel
{
  protected $table = 'events_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_Id' => 'userId',
    'title' => 'title',
    'banner_Url' => 'bannerUrl',
    'content' => 'content',
    'status' => 'status',
    'created_At' => 'createdAt',
    'updated_At' => 'updatedAt'
  ];
}
