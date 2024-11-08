<?php
class UserModel extends BaseModel
{
  protected $table = 'users'; // Đặt tên bảng

  public function addUser($user) {
    $data = [
      'username' => $user['username'],
      'email' => $user['email'],
      'password' => password_hash($user['password'], PASSWORD_DEFAULT)
    ];

    $this->create($data);
  }


}