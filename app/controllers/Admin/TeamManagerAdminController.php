<?php
AdminLoader::model('UserModel');
class TeamManagerAdminController extends AdminBaseController
{
  public static function index()
  {
    ConstantsAdmin::teamManagerPage();

    // Set data for View
    self::setAllData(data: self::setTableData());

    self::renderAdmin('TeamManager/main');
  }

  public static function setTableData()
  {
    AdminLoader::model('UserModel');
    AppLoader::feature('pagination');
    [
      'perPage' => $perPage,
      'page' => $page
    ] = pagination();

    $userData = UserModel::getUsers(
      orderBy: 'updated_at',
      conditions: ['role' => 1],
      userPerPage: $perPage,
      page: $page
    );

    return [
      'userData' => $userData['data'],
      'totalPage' => $userData['total'],
      'perPage' => $userData['per_page'],
      'currentPage' => $userData['current_page'],
      'lastPage' => $userData['last_page'],
      'nextPage' => min($userData['current_page'] + 1, $userData['last_page']),
      'previousPage' => max($userData['current_page'] - 1, 1),
    ];
  }
}