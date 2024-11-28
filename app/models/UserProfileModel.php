<?php
class UserProfileModel extends BaseModel
{
  public static $table = 'user_profiles_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'banner_url' => 'bannerUrl',
    'location' => 'location',
    'website' => 'website',
    'social_accounts' => 'socialAccounts',
    'bio' => 'bio',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];
}
