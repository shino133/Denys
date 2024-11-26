<?php
class UserModel extends BaseModel
{
  public $table = 'users_table'; // Đặt tên bảng
  public $columns = [
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
}
