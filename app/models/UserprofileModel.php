<?php
class UserprofileModel extends BaseModel
{
  protected $table = 'user_profiles_table'; // Đặt tên bảng
  protected $column = [
    'id' => 'id',
    'user_Id' => 'userId',
    'banner_Url' => 'bannerUrl',
    'location' => 'location',
    'website' => 'website',
    'social_Accounts' => 'socialAccounts',
    'bio' => 'bio',
    'status' => 'status',
    'created_At' => 'createdAt',
    'updated_At' => 'updatedAt'
  ];
}
