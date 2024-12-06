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


  public static function getProfile($userId, $conditions = null, $limit = 1) : array
  {
    $user_table = "users_table";

    $joins = [
      [
        'type' => 'INNER',
        'table' => $user_table,
        'on' => "$user_table.id = " . self::$table . ".userId"
      ]
    ];

    $conditions ??= [
      'userId' => $userId,
      "$user_table.status" => 'active'
    ];

    $columns = [
      self::$table . ".id as profile_id",
      self::$table . ".bannerUrl as profile_bannerUrl",
      self::$table . ".location as profile_location",
      self::$table . ".website as profile_website",
      self::$table . ".socialAccounts as profile_socialAccounts",
      self::$table . ".bio as profile_bio",
      self::$table . ".status as profile_status",
      self::$table . ".createdAt as profile_createdAt",
      self::$table . ".updatedAt as profile_updatedAt",
      $user_table . ".id as user_id",
      $user_table . ".fullName as user_fullName",
      $user_table . ".userName as user_userName",
      $user_table . ".avatarUrl as user_avatarUrl",
      $user_table . ".email as user_email",
      $user_table . ".status as user_status",
      $user_table . ".role as user_role",
      $user_table . ".createdAt as user_createdAt",
      $user_table . ".updatedAt as user_updatedAt"
    ];

    return self::join(
      joins: $joins,
      columns: $columns,
      conditions: $conditions,
      orderBy: null,
      limit: $limit);
  }

}
