<?php
namespace App\Services;

use App\Models\UserModel;
use App\Models\UserProfileModel;

class UserProfileService
{
  public static function getProfile($userId, $conditions = null, $limit = 1): array
  {
    // Lấy thông tin bảng và cột user
    $userTable = UserModel::$table;
    $userAlias = UserModel::$alias;
    $userColumns = UserProfileModel::aliasColumns(columns: UserModel::$columns,
      table: $userTable, alias: $userAlias);

    // Lấy thông tin bảng và cột profile
    $profileTable = UserProfileModel::$table;
    $profileAlias = UserProfileModel::$alias;
    $profileColumns = UserProfileModel::aliasColumns(columns: UserProfileModel::$columns,
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
    return UserProfileModel::join(
      joins: $joins,
      columns: $columns,
      conditions: $conditions,
      orderBy: null,
      limit: $limit
    );
  }
}