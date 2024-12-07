<?php
class UserProfileModel extends BaseModel
{
  public static $table = 'user_profiles_table'; // Đặt tên bảng
  public static $alias = 'profile';
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
    AppLoader::model('UserModel');

    // Lấy thông tin bảng và cột user
    $userTable = UserModel::$table;
    $userAlias = UserModel::$alias;
    $userColumns = self::aliasColumns(columns: UserModel::$columns,
      table: $userTable, alias: $userAlias);

    // Lấy thông tin bảng và cột profile
    $profileTable = self::$table;
    $profileAlias = self::$alias;
    $profileColumns = self::aliasColumns(columns: self::$columns,
      table: $profileTable, alias: $profileAlias);

    // Cấu hình join
    $joins = [
      [
        'type' => 'INNER',
        'table' => $userTable,
        'on' => "$userTable.id = $profileTable.userId"
      ]
    ];

    // Điều kiện mặc định
    $conditions ??= [
      "$profileTable.userId" => $userId,
      "$userTable.status" => 'active'
    ];

    // Gộp cột profile và user
    $columns = array_merge($profileColumns, $userColumns);

    // Truy vấn
    return self::join(
      joins: $joins,
      columns: $columns,
      conditions: $conditions,
      orderBy: null,
      limit: $limit
    );
  }

}
