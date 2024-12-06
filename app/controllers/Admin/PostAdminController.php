<?php
AdminLoader::model('PostModel');

class PostAdminController extends AdminBaseController
{
  public static function index() {
    ConstantsAdmin::postPage();

    AppLoader::feature('pagination');
    [
      'perPage' => $perPage,
      'page' => $page
    ] = pagination();

    $postData = PostModel::getPosts(
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

    // dumpVar($postData);

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
    ConstantsAdmin::postPage();

    self::renderAdmin('Post/add');
  }

  public static function addData() {
    AdminLoader::util('TimeHelper');
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

    dumpVar($data);
    
  }
  public static function destroyData($id)
  {
    Action::set('reverse', function ($msg = 'Something went wrong', $status = 'error') {
      Url::setNofi(msg: $msg, status: $status);
      self::reverse(Url::getQueryString());
    });

    Action::set('updateStatus', function () use ($id) {
      AdminLoader::util('TimeHelper');

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
      AppLoader::controller('AssetController');
      $uploadImage = AssetController::upImage($inputName);
    }

    if (isset($uploadImage['error'])) {
      Action::run('reverse', $uploadImage['error']);
    }

    return $uploadImage;
  }
}