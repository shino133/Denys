<?php
namespace App\Models;

class UserModel extends Model
{
  public static $table = 'users_table'; // Đặt tên bảng
  public static $alias = 'user';
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
    'updated_at' => 'updatedAt'
  ];
}
