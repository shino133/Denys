<?php
namespace App\Controllers\Admin;

use App\Constants\Admin\ConstantAdmin;
use App\Controllers\AssetController;
use App\Controllers\AuthController;
use App\Features\Auth;
use App\Features\Pagination;
use App\Models\UserModel;
use App\Services\UserService;
use App\Utils\DataValidator;
use App\Utils\Helpers\Action;
use App\Utils\Helpers\Store;
use App\Utils\Helpers\Url;
use App\Utils\TimeHelper;

use function App\Features\pagination;

class UserAdminController extends AdminBaseController
{
  public static function index()
  {
    ConstantAdmin::userPage();

    // $userData = UserModel::getUsers(orderBy: 'updated_at', limit: null, conditions: []);
    [
      'perPage' => $perPage,
      'page' => $page
    ] = Pagination::get();

    $userData = UserModel::find(
      orderBy: 'updatedAt DESC',
      conditions: [],
      limit: $perPage,
      offset: ($page - 1) * $perPage
    );

    foreach ($userData as $key => $user) {
      $userData[$key]['role'] = match ($user['role']) {
        0 => 'editor',
        1 => 'admin',
        2 => 'user',
        default => 'user',
      };
    }

    $userData = UserModel::paginate(
      page: $page,
      perPage: $perPage,
      conditions: [],
      data: $userData
    );

    // Set data for View
    self::setAllData(data: [
      'userData' => $userData['data'],
      'totalPage' => $userData['total'],
      'perPage' => $userData['per_page'],
      'currentPage' => $userData['current_page'],
      'lastPage' => $userData['last_page'],
      'nextPage' => min($userData['current_page'] + 1, $userData['last_page']),
      'previousPage' => max($userData['current_page'] - 1, 1),
    ]);

    self::renderAdmin('User/main');
  }

  public static function addPage()
  {
    ConstantAdmin::userPage();
    self::renderAdmin('User/add');
  }
  public static function editPage($userId)
  {
    ConstantAdmin::userPage('edit');

    $userData = UserService::getUserById($userId);

    if (empty($userData)) {
      Url::setNofi(msg: 'Người dùng không tồn tại', status: 'error');
      self::reverse(Url::getQueryString());
    }

    self::setData('userData', $userData);

    self::renderAdmin('User/edit');
  }

  public static function searchPage()
  {
    ConstantAdmin::userPage();

    self::renderAdmin('User/search');
  }

  public static function addData()
  {
    Action::set('reverse', function ($msg = 'Something went wrong', $status = 'error') {
      Url::setNofi(msg: $msg, status: $status);
      self::reverse(Url::getQueryString());
    });

    Action::set('errorEvent', function ($msg = 'Người dùng đã tồn tại') {
      Url::setNofi(msg: $msg, status: 'error');
      self::reverse(Url::getQueryString());
    });

    $res = AuthController::registerRun();

    $uploadAvatar = self::uploadAvatar('avatarUrl');

    $data['avatarUrl'] = $uploadAvatar['fileName'] ?? '';
    $data['role'] = isset($_POST['isAdmin']) ? 1 : 2;

    UserModel::update(conditions: [
      'id' => $res
    ], data: $data);

    Action::run('reverse', 'Registered', 'success');
  }

  public static function editData($userId)
  {

    Action::set('reverse', function ($msg = 'Something went wrong', $status = 'error') {
      Url::setNofi(msg: $msg, status: $status);
      self::reverse(Url::getQueryString());
    });

    $userData = UserModel::find(conditions: ['id' => $userId], limit: 1);

    if (empty($userData)) {
      Action::run('reverse', 'Không tìm thấy người dùng', 'error');
    }

    $userData = $userData[0];

    if ($userData['role'] === 0 && Auth::checkAdminEditor() === false) {
      Action::run('reverse', 'Không có quyền sửa người dùng', 'error');
    }

    $data = [
      'userName' => $_POST['username'] ?? $userData['userName'],
      'fullName' => $_POST['fullName'] ?? $userData['fullName'],
      'email' => $_POST['email'] ?? $userData['email'],
      'role' => isset($_POST['isAdmin']) ? 1 : 2,
      'status' => isset($_POST['status']) ? 'active' : 'delete',
      'updatedAt' => TimeHelper::getNow('Y-m-d H:i:s')
    ];

    if ((int) $userData['role'] === 0) {
      $data['role'] = 0;
    }

    if (DataValidator::check($data) == false) {
      Action::run('reverse', 'Vui lòng nhập đủ dữ liệu');
    }

    $uploadAvatar = self::uploadAvatar('avatarUrl');
    if (isset($uploadAvatar['fileName']) && $uploadAvatar['fileName'] != '') {
      $data['avatarUrl'] = $uploadAvatar['fileName'];
    }

    $res = UserModel::update(conditions: [
      'id' => $userId
    ], data: $data);

    [$msg, $status] = $res
      ? ['Updated', 'success']
      : ['Something went wrong', 'error'];

    Action::run('reverse', $msg, $status);
  }
  public static function destroyData($userId)
  {
    Action::set('reverse', function ($msg = 'Something went wrong', $status = 'error') {
      Url::setNofi(msg: $msg, status: $status);
      self::reverse(Url::getQueryString());
    });

    Action::set('updateStatus', function () use ($userId) {
      $res = UserModel::update(conditions: [
        'id' => $userId
      ], data: [
        'status' => 'delete',
        'updatedAt' => TimeHelper::getNow('Y-m-d H:i:s')
      ]);

      [$msg, $status] = $res
        ? ['Deleted', 'success']
        : ['Something went wrong', 'error'];

      Action::run('reverse', $msg, $status);
    });

    if ($userId == Auth::getUser()['id']) {
      Action::run('reverse', 'Không thể xoá bản thân', 'error');
    }

    $userData = UserModel::find(conditions: ['id' => $userId], limit: 1);


    if (empty($userData)) {
      Action::run('reverse', 'Không tìm thấy người dùng', 'error');
    }

    $userData = $userData[0];

    if ($userData['role'] === 0 && Auth::checkAdminEditor() === false) {
      Action::run('reverse', 'Không có quyền xoá người dùng', 'error');
    }

    // WHEN: User isn't deleted
    if ($userData['status'] !== 'delete') {
      Action::run('updateStatus');
    }

    // IF: User is deleted, but don't have editor permission
    if (Auth::checkAdminEditor() == false) {
      Action::run('reverse', "Không có quyền xoá người dùng này", 'error');
    }

    $res = UserModel::delete(conditions: [
      'id' => $userId
    ]);

    [$msg, $status] = $res
      ? ['Deleted', 'success']
      : ['Something went wrong', 'error'];

    Action::run('reverse', $msg, $status);
  }

  public static function searchData()
  {
    $ac = [
      'render' => 'renderSearchPage'
    ];

    Action::set($ac['render'], function () {
      ConstantAdmin::teamManagerPage();
      self::renderAdmin('User/search');
    });

    $params = Store::getQueryParams();
    if (isset($params) == false || count($params) == 0) {
      Action::run($ac['render']);
      return;
    }

    [
      'perPage' => $perPage,
      'page' => $page
    ] = Pagination::get();

    $keyword = [
      'userName' => $params['username'] ?? '',
      'email' => $params['email'] ?? ''
    ];

    foreach ($keyword as $key => $value) {
      if (empty($value)) {
        unset($keyword[$key]);
      }
    }

    if (empty($keyword)) {
      Action::run($ac['render']);
      return;
    }

    $userData = UserModel::search($keyword, 'OR', []);

    $userData = UserService::getUsers(
      orderBy: 'updated_at',
      conditions: [],
      userPerPage: $perPage,
      page: $page,
      userData: $userData ?? []
    );

    // Set data for View
    self::setAllData(data: [
      'userData' => $userData['data'],
      'totalPage' => $userData['total'],
      'perPage' => $userData['per_page'],
      'currentPage' => $userData['current_page'],
      'lastPage' => $userData['last_page'],
      'nextPage' => min($userData['current_page'] + 1, $userData['last_page']),
      'previousPage' => max($userData['current_page'] - 1, 1),
    ]);

    Action::run($ac['render']);
  }


  public static function uploadAvatar($inputName = 'avatarUrl')
  {
    $uploadImage = [];
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['name'] != '') {
      $uploadImage = AssetController::upImage($inputName);
    }

    if (isset($uploadImage['error'])) {
      Action::run('reverse', $uploadImage['error']);
    }

    return $uploadImage;
  }
}