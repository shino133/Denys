
<?php
class UserfollowModel extends BaseModel
{
  protected $table = 'user_follows_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'userld' => 'userld',
    'followerld' => 'followerld',
    'createdAt' => 'createdAt'
  ];
}
