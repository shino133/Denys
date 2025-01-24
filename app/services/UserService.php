<?php
namespace App\Services;

use App\Models\UserModel;

class UserService extends Service
{
  public static function getUsers(
    $orderBy = 'created_at',
    $conditions = ['status' => "active"],
    $userPerPage = 10,
    $page = 1,
    $userData = []
  ) {
    if (empty($userData)) {
      $orderBy = isset(UserModel::$columns[$orderBy])
        ? UserModel::$columns[$orderBy]." DESC"
        : null;

      $userData = UserModel::find(
        conditions: $conditions,
        columns: [
          'id' => 'id',
          'user_name' => 'userName',
          'full_name' => 'fullName',
          'email' => 'email',
          'avatar_url' => 'avatarUrl',
          'status' => 'status',
          'role' => 'role',
          'created_at' => 'createdAt',
          'updated_at' => 'updatedAt'
        ],
        orderBy: $orderBy,
        limit: $userPerPage,
        offset: ($page - 1) * $userPerPage
      );
    }

    foreach ($userData as $key => $user) {
      $userData[$key]['role'] = match ($user['role']) {
        0 => 'editor',
        1 => 'admin',
        2 => 'user',
        default => 'user',
      };
    }

    // dumpVar($userData);
    return UserModel::paginate(
      page: $page,
      perPage: $userPerPage,
      data: $userData
    );
  }

  public static function getUserById($id): array
  {
    $userData = UserModel::find(
      conditions: ['id' => $id],
      columns: [
        'id' => 'id',
        'user_name' => 'userName',
        'full_name' => 'fullName',
        'email' => 'email',
        'avatar_url' => 'avatarUrl',
        'role' => 'role',
        'status' => 'status',
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt'
      ],
      limit: 1
    );

    if (empty($userData)) {
      return [];
    }

    $userData = $userData[0];
    $userData['role'] = match ($userData['role']) {
      0 => 'editor',
      1 => 'admin',
      2 => 'user',
      default => 'user',
    };

    return $userData;
  }
  public static function getTeamManager()
  {
    return UserModel::find(
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
      orderBy: UserModel::$columns['created_at'].' DESC'
    );
  }

  public static function getByUserName($userName): array
  {
    return UserModel::find(
      conditions: ['userName' => $userName],
      columns: [
        'id' => 'id',
        'user_name' => 'userName',
        'full_name' => 'fullName',
        'email' => 'email',
        'avatar_url' => 'avatarUrl',
        'status' => 'status',
        'created_at' => 'createdAt',
      ],
      limit: 1
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