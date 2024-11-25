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

    // Action default
    Action::set(function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      $this->reverse(Url::getQueryString());
    });

    // Upload image
    $uploadImage = [];
    if (isset($_FILES["post_image"])) {
      AppLoader::controller('AssetController');
      $uploadImage = (new AssetController())->upImage("post_image");
    }

    if ($uploadImage['success'] == false) {
      Action::run('Lỗi tải ảnh', 'error');
    }

    // Set data post
    $data = [
      'user_id' => Auth::get("user_id"),
      'title' => '',
      'content' => $_POST['content'],
      'media_type' => 'p',
      'media_url' => $uploadImage['fileName'] ?? '',
    ];

    $dataNullable = [
      'title',
      'media_url'
    ];

    // Validate
    if (DataValidator::check($data, $dataNullable) == false) {
      Action::run('Không được để trống', 'error');
    }

    // Add post
    $res = $this->postModel->addPost($data);
    if ($res == false) {
      Action::run('Vui lòng thử lại', 'error');
    }

    // Redirect
    Action::run('Đăng bài viết thành công', 'success');
  }
}