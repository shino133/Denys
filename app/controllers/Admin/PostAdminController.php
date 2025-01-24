<?php
namespace App\Controllers\Admin;

use App\Constants\Admin\ConstantAdmin;
use App\Controllers\AssetController;
use App\Controllers\PostController;
use App\Features\Pagination;
use App\Models\PostModel;
use App\Services\PostService;
use App\Utils\DataValidator;
use App\Utils\Helpers\Action;
use App\Utils\Helpers\Url;
use App\Utils\TimeHelper;

use function App\Features\pagination;

class PostAdminController extends AdminBaseController
{
  public static function index() {
    ConstantAdmin::postPage();

    [
      'perPage' => $perPage,
      'page' => $page
    ] = Pagination::get();

    $postData = PostService::getPosts(
      orderBy: 'created_at',
      conditions: [],
      limit: $perPage,
      offset: ($page - 1) * $perPage,
    );

    $postData = PostModel::paginate(
      page: $page,
      perPage: $perPage,
      conditions: [],
      data: $postData
    );

    
    self::setAllData(data: [
      'postData' => $postData['data'],
      'totalPage' => $postData['total'],
      'perPage' => $postData['per_page'],
      'currentPage' => $postData['current_page'],
      'lastPage' => $postData['last_page'],
      'nextPage' => min($postData['current_page'] + 1, $postData['last_page']),
      'previousPage' => max($postData['current_page'] - 1, 1),
    ]);
    
    self::renderAdmin('Post/main');
  }

  public static function addPage() {
    ConstantAdmin::postPage();
    self::renderAdmin('Post/add');
  }

  public static function editPage($id) {
    ConstantAdmin::postPage();

    [$post] = PostController::getPostById($id, []);

    self::setAllData(data: [
      'post' => $post
    ]);

    self::renderAdmin('Post/edit');
  }

  public static function editData($id) {

    Action::set('reverse', function ($msg = 'Something went wrong', $status = 'error') {
      Url::setNofi(msg: $msg, status: $status);
      self::reverse(Url::getQueryString());
    });

    $data = [
      'content' => $_POST['content'],
      'status' => isset($_POST['status'])? 'active' : 'delete',
      'updatedAt' => TimeHelper::getNow('Y-m-d H:i:s'),
    ];

    // Validate
    if (DataValidator::check($data) == false) {
      Action::run('reverse', 'Vui lòng không để trống', 'error');
    }

    $postData = PostModel::find(conditions: ['id' => $id], limit: 1)[0] ?? null;

    if (empty($postData)) {
      Action::run('reverse', 'Không tìm thấy bài viết', 'error');
    }

    // Upload image
    $uploadImage = [];
    if (isset($_FILES["mediaUrl"]) && $_FILES["mediaUrl"]['name'] != '') {
      $uploadImage = AssetController::upImage("mediaUrl");
    }

    if (isset($uploadImage['success']) && $uploadImage['success'] === false) {
      Action::run('reverse', 'Lỗi tải ảnh', 'error');
    }

    $data['mediaUrl'] = $uploadImage['fileName'] ?? $postData['mediaUrl'];

    $res = PostModel::update(conditions: [
      'id' => $id
    ], data: $data);

    [$msg, $status] = $res
      ? ['Updated', 'success']
      : ['Something went wrong', 'error'];

    Action::run('reverse', $msg, $status);
    
  }

  public static function addData() {
    Action::set('reverse', function ($msg = 'Something went wrong', $status = 'error') {
      Url::setNofi(msg: $msg, status: $status);
      self::reverse(Url::getQueryString());
    });

    $data = [
      'title' => $_POST['title']?? null,
      'content' => $_POST['content'],
      'status' => isset($_POST['status'])? 'active' : 'delete',
      'createdAt' => TimeHelper::getNow('Y-m-d H:i:s'),
      'updatedAt' => TimeHelper::getNow('Y-m-d H:i:s'),
    ];

    // dumpVar($data);
    
  }
  public static function destroyData($id)
  {
    Action::set('reverse', function ($msg = 'Something went wrong', $status = 'error') {
      Url::setNofi(msg: $msg, status: $status);
      self::reverse(Url::getQueryString());
    });

    Action::set('updateStatus', function () use ($id) {
      $res = PostModel::update(conditions: [
        'id' => $id
      ], data: [
        'status' => 'delete',
        'updatedAt' => TimeHelper::getNow('Y-m-d H:i:s')
      ]);

      [$msg, $status] = $res
        ? ['Deleted', 'success']
        : ['Something went wrong', 'error'];

      Action::run('reverse', $msg, $status);
    });

    $postData = PostModel::find(conditions: ['id' => $id], limit: 1);


    if (empty($postData)) {
      Action::run('reverse', 'Không tìm thấy', 'error');
    }

    $postData = $postData[0];

    // WHEN: User isn't deleted
    if ($postData['status'] !== 'delete') {
      Action::run('updateStatus');
    }

    $res = PostModel::delete(conditions: [
      'id' => $id
    ]);

    [$msg, $status] = $res
      ? ['Deleted', 'success']
      : ['Something went wrong', 'error'];

    Action::run('reverse', $msg, $status);
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