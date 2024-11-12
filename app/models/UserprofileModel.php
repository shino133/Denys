<?php
class UserprofileModel extends BaseModel
{
  protected $table = 'user_profiles_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'userld' => 'userld',
    'bannerUrl' => 'bannerUrl',
    'location' => 'location',
    'website' => 'website',
    'socialAccounts' => 'socialAccounts',
    'bio' => 'bio',
    'status' => 'status',
    'createdAt' => 'createdAt',
    'updatedAt' => 'updatedAt'
  ];
}
