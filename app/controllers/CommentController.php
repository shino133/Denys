<?php
AppLoader::model('CommentModel');
class CommentController extends BaseController
{
  private $commentModel;

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
      $newCommentId = CommentModel::addComment($data);
      $isSuccess = $newCommentId !== false;
      if ($isSuccess) {
        $data['comments_id'] = $newCommentId;
        Action::run('addPostComment', $data);
      }

      Action::run('default', $isSuccess);
    });

    Action::set('addPostComment', function ($data) {
      AppLoader::model('PostCommentModel');
      $newPostCommentId = PostCommentModel::addPostComment($data);
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
      AppLoader::controller('AssetController');
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

  public static function getCommentByPostId($postId, $orderBy = 'createdAt', $limit = null): array
  {
    $userTable = "users_table";
    $commentTable = "comments_table";
    $postCommentTable = "post_comments_table";

    $joins = [
      [
        'type' => 'INNER',
        'table' => $userTable,
        'on' => "$userTable.id = $commentTable.userId"
      ],
      [
        'type' => 'LEFT',
        'table' => $postCommentTable,
        'on' => "$postCommentTable.commentsId = $commentTable.id"
      ]
    ];

    $columns = [
      "$commentTable.id as comment_id",
      "$commentTable.content as comment_content",
      "$commentTable.mediaType as comment_mediaType",
      "$commentTable.mediaUrl as comment_mediaUrl",
      "$commentTable.userId as user_userId",
      "$userTable.userName as user_userName",
      "$userTable.fullName as user_fullName",
      "$userTable.avatarUrl as user_avatarUrl",
      // "$postCommentTable.id as postComment_id",
      // "$postCommentTable.postId as postComment_postId",
      "$postCommentTable.createdAt as postComment_createdAt",
    ];

    $conditions = [
      "$postCommentTable.postId" => $postId
    ];

    if ($orderBy) {
      $orderBy = "$postCommentTable.$orderBy DESC";
    }

    $comments = CommentModel::join($joins, $columns, $conditions, $orderBy, $limit);

    if (!isset($comments) || $comments === false) {
      return [];
    }

    AppLoader::util('TimeHelper');
    foreach ($comments as $key => $comment) {
      $comments[$key]['timeAgo'] = TimeHelper::timeAgo($comment['postComment_createdAt']);
    }

    return $comments;
  }
}