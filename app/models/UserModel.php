<?php
class UserModel extends BaseModel
{
  protected $table = 'users_table'; // Đặt tên bảng

  public function addUser($user) {
    if (!isset($user)) {
      return false; // Trả về false nếu user không tồn tại
    }

    $dataUser = [
      'userName' => $user['username'],
      'email' => $user['email'],
      'password' => encryptData($user['password']),
      'fullName' => $user['fullName'],
      'avatarUrl' => $user['avatarUrl'] ?? null,
    ];

    return $this->create($dataUser);
  }


}