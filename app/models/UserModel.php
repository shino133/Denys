<?php
class UserModel extends BaseModel
{
  public static $table = 'users_table'; // Đặt tên bảng
  public static $columns = [
    'id' => 'id',
    'user_name' => 'userName',
    'password' => 'password',
    'full_name' => 'fullName',
    'email' => 'email',
    'avatar_url' => 'avatarUrl',
    'role' => 'role',
    'verify_email_at' => 'verifyEmailAt',
    'status' => 'status',
    'created_at' => 'createdAt',
    'update_at' => 'updateAt'
  ];

  public static function getTeamManager()
  {
    return self::find(
      conditions: ['role' => 1],
      columns: [
        'id' => 'id',
        'user_name' => 'userName',
        'full_name' => 'fullName',
        'email' => 'email',
        'avatar_url' => 'avatarUrl',
        'status' => 'status',
        'created_at' => 'createdAt',
      ],
      orderBy: self::$columns['created_at'] . ' DESC'
    );
  }

  public static function validatePublicData($data)
  {
    return [
      'id' => $data['id'],
      'user_name' => $data['userName'],
      'email' => $data['email'],
      'full_name' => $data['fullName'],
      'avatar_url' => $data['avatarUrl'],
      'role' => $data['role']
    ];
  }
}
