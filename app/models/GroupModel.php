<?php
class GroupModel extends BaseModel
{
  public static $table = 'groups_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'name' => 'name',
    'banner_url' => 'bannerUrl',
    'bio' => 'bio',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];

  public static function getGroups($orderBy = 'created_at', $conditions = ['status' => "active"] ,$limit = 10)
  {
    $userTable = "users_table";

    $joins = [
      [
        'type' => 'INNER',
        'table' => $userTable,
        'on' => "$userTable.id = " . self::$table . ".userId"
      ],
    ];

    $columns = [
      self::$table . ".id as group_id",
      self::$table . ".name as group_name",
      self::$table . ".bannerUrl as group_bannerUrl",
      self::$table . ".status as group_status",
      self::$table . ".createdAt as group_createdAt",
      $userTable . ".fullName as user_fullName",
      $userTable . ".userName as user_userName",
    ];

    if ($orderBy) {
      $orderBy = "" . self::$table . "." . self::$columns[$orderBy] . " DESC";
    }

    return self::join($joins, $columns, $conditions, $orderBy, $limit);
  }
}
