<?php
class EventModel extends BaseModel
{
  public static $table = 'events_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'user_id' => 'userId',
    'title' => 'title',
    'banner_url' => 'bannerUrl',
    'content' => 'content',
    'status' => 'status',
    'created_at' => 'createdAt',
    'updated_at' => 'updatedAt'
  ];

  public static function getEvents($orderBy = 'created_at', $conditions = ['status' => "active"], $limit = 10)
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
      self::$table . ".id as event_id",
      self::$table . ".title as event_title",
      self::$table . ".bannerUrl as event_bannerUrl",
      self::$table . ".content as event_content",
      self::$table . ".status as event_status",
      self::$table . ".createdAt as event_createdAt",
      self::$table . ".updatedAt as event_updatedAt",
      $userTable . ".fullName as user_fullName",
      $userTable . ".userName as user_userName",
    ];
    
    if ($orderBy) {
      $orderBy = "" . self::$table . "." . self::$columns[$orderBy] . " DESC";
    }
    
    return self::join($joins, $columns, $conditions, $orderBy, $limit);
  }

}
