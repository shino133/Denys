<?php
AppLoader::model('PostModel');
class PostController extends BaseController
{
  private $postModel;

  public function __construct()
  {
    $this->postModel = new PostModel();
  }

  public function addPost()
  {
    AppLoader::util('DataValidator');

    // Action reverse
    Action::set('reverse',function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      $this->reverse(Url::getQueryString());
    });

    // Action add post
    Action::set('addPost',function ($data) {
      $res = $this->postModel->addPost($data);
      $args = $res == false
        ? ['Vui lòng thử lại', 'error']
        : ['Đăng bài viết thành công', 'success'];

      Action::run('reverse', ...$args);
    });

    // Set data post
    $data = [
      'user_id' => Auth::get("user_id"),
      'title' => '',
      'content' => $_POST['content'],
      'media_type' => 'p',
      'media_url' => '',
    ];

    $dataNullable = [
      'title',
      'media_url'
    ];

    // Validate
    if (DataValidator::check($data, $dataNullable) == false) {
      Action::run('reverse','Không được để trống', 'error');
    }

    // Upload image
    $uploadImage = [];
    if (isset($_FILES["post_image"])) {
      AppLoader::controller('AssetController');
      $uploadImage = (new AssetController())->upImage("post_image");
    }

    if ($uploadImage['success'] == false) {
      Action::run('reverse','Lỗi tải ảnh', 'error');
    }

    $data['media_url'] = $uploadImage['fileName'] ?? '';

    // Redirect
    Action::run('addPost', $data);
  }

  public function getPost()
  {
    
  }
}