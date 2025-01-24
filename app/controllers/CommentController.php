<?php
namespace App\Controllers;

use App\Features\Auth;
use App\Models\CommentModel;
use App\Services\CommentService;
use App\Services\PostCommentService;
use App\Utils\Helpers\Action;
use App\Utils\Helpers\Url;
use App\Utils\TimeHelper;

class CommentController extends Controller
{

  public static function addComment($postId)
  {
    // Action reverse
    Action::set('reverse', function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      self::reverse(Url::getQueryString());
    });

    // Action default
    Action::set('default', function ($isSuccess = true) {
      $args = $isSuccess
        ? ['Đăng tải bình luận thành công', 'success']
        : ['Vui lòng thử lại', 'error'];

      Action::run('reverse', ...$args);
    });

    // Action add comment
    Action::set('addComment', function ($data) {
      $newCommentId = CommentService::addComment($data);
      $isSuccess = $newCommentId !== false;
      if ($isSuccess) {
        $data['comment_id'] = $newCommentId;
        Action::run('addPostComment', $data);
      }

      Action::run('default', $isSuccess);
    });

    Action::set('addPostComment', function ($data) {
      $newPostCommentId = PostCommentService::addPostComment($data);
      $isSuccess = $newPostCommentId !== false;
      Action::run('default', $isSuccess);
    });

    // Set data comment
    $data = [
      'user_id' => Auth::getUser()['id'],
      'content' => $_POST['content'],
      'media_type' => 'c',
      'post_id' => $postId
    ];

    // Set data image
    $inputImageName = 'comment_image';
    $uploadImage = [];

    // Validate
    $isHaveImage = isset($_FILES[$inputImageName]) && $_FILES[$inputImageName]['name'] != '';
    $isHaveContent = isset($data['content']) && $data['content'] != '';

    $isHaveEmptyData = ($isHaveImage || $isHaveContent) == false;

    // Upload image
    if ($isHaveImage == true) {                                                               
      $uploadImage = AssetController::upImage("comment_image");

      // Validate
      if (!isset($uploadImage['success']) || $uploadImage['success'] === false) {
        Action::run('reverse', 'Lỗi tải ảnh', 'error');
      }
    }

    // Set data image for comment
    $data['media_url'] = $uploadImage['fileName'] ?? null;

    // Validate
    $isHaveNoImage = (isset($data['media_url']) && $data['media_url'] !== '') == false;
    if ($isHaveEmptyData && $isHaveNoImage) {
      Action::run('reverse', 'Vui lòng không để trống', 'error');
    }

    // Upload comment and Redirect
    Action::run('addComment', $data);
  }
}