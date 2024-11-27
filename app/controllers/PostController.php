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
    Action::set('reverse', function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      $this->reverse(Url::getQueryString());
    });

    // Action add post
    Action::set('addPost', function ($data) {
      $res = $this->postModel->addPost($data);
      $args = $res == false
        ? ['Vui lòng thử lại', 'error']
        : ['Đăng bài viết thành công', 'success'];

      Action::run('reverse', ...$args);
    });

    // Set data post
    $data = [
      'user_id' => Auth::getUser()['id'],
      'content' => $_POST['content'],
      'media_type' => 'p',
    ];

    // Validate
    if (DataValidator::check($data) == false) {
      Action::run('reverse', 'Vui lòng không để trống', 'error');
    }

    // Upload image
    $uploadImage = [];
    if (isset($_FILES["post_image"]) && $_FILES["post_image"]['name'] != '') {
      AppLoader::controller('AssetController');
      $uploadImage = (new AssetController())->upImage("post_image");
    }

    if (isset($uploadImage['success']) && $uploadImage['success'] === false) {
      Action::run('reverse', 'Lỗi tải ảnh', 'error');
    }

    $data['media_url'] = $uploadImage['fileName'] ?? '';

    // Redirect
    Action::run('addPost', $data);
  }

  public function getPostById($postId)
  {
    Action::set('reverse', function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      $this->reverse(Url::getQueryString());
    });

    // Set action get comments
    Action::set('getComments', function ($postId) {
      AppLoader::controller('CommentController');
      return (new CommentController())->getCommentByPostId($postId);
    });

    // Get post 
    
    $posts = $this->getPosts(
      orderBy: null,
      conditions: ['id' => $postId],
      limit: 1,
    );

    if (!$posts) {
      Action::run('reverse', 'Không tìm tháy bài viết', 'error');
    }

    // Get comments
    $postId = $posts[0]['post_id'];
    $posts[0]['comments'] = Action::run('getComments', $postId);

    //Get isLikedByCurrentUser
    $posts[0]['isLikedByCurrentUser'] = $posts[0]['isLikedByCurrentUser'] == 1;

    $this->setData('posts', $posts);

    Constants::homePage();
    $this->render('Post/main');
  }

  public function getPosts($orderBy = 'created_at', $conditions = ['status' => "active"], $limit = 10): array|bool
  {
    $userTable = "users_table";
    $postTable = "posts_table";
    $postCommentTable = "post_comments_table";
    $postLikeTable = "post_likes_table";

    $joins = [
      [
        'type' => 'INNER',
        'table' => $userTable,
        'on' => "$userTable.id = $postTable.userId"
      ],
      [
        'type' => 'LEFT',
        'table' => $postCommentTable,
        'on' => "$postCommentTable.postId = $postTable.id"
      ],
      [
        'type' => 'LEFT',
        'table' => $postLikeTable,
        'on' => "$postLikeTable.postId = $postTable.id"
      ]
    ];

    $columns = [
      "$postTable.id as post_id",
      "$postTable.content as post_content",
      "$postTable.mediaType as post_mediaType",
      "$postTable.mediaUrl as post_mediaUrl",
      "$postTable.createdAt as post_createdAt",
      "$postTable.userId as user_userId",
      "$userTable.userName as user_userName",
      "$userTable.fullName as user_fullName",
      "$userTable.avatarUrl as user_avatarUrl",
      "COUNT(DISTINCT $postCommentTable.id) as commentCount",
      "COUNT(DISTINCT $postLikeTable.postId) as likeCount",
    ];

    $currentUserId = Auth::getUser()['id'];
    if ($currentUserId) {
      $columns[] = "MAX($postLikeTable.userId = $currentUserId) as isLikedByCurrentUser";
    }

    $conditionsValid = [];
    foreach ($conditions as $field => $value) {
      $conditionsValid["$postTable.$field"] = $value;
    }

    if ($orderBy) {
      $orderBy = "$postTable." . $this->postModel->columns[$orderBy] . " DESC";
    }

    $groupBy = "$postTable.id";

    $posts = $this->postModel->join($joins, $columns, $conditionsValid, $orderBy, $limit, null, $groupBy);

    if (!isset($posts) || $posts == false) {
      return false;
    }

    AppLoader::util('TimeHelper');
    foreach ($posts as $key => $post) {
      $posts[$key]['timeAgo'] = TimeHelper::timeAgo($post['post_createdAt']);
    }

    return $posts;
  }

  public function getNewPosts($limit = 10, $useCache = true)
  {
    Action::set('getNewPosts', function ($limit) {
      return $this->getPosts('created_at', ['status' => "active"], $limit);
    });

    //WHEN: Don't use cache
    if ($useCache == false) {
      return Action::run('getNewPosts', $limit);
    }

    // Get from cache
    $posts = Cache::get('newPosts', 'posts/');
    if (isset($posts) && $posts !== false) {
      return $posts;
    }

    // Get from database
    $posts = Action::run('getNewPosts', $limit);

    // Save to cache
    Cache::set('newPosts', $posts, 60, 'posts/');
    return $posts;
  }
}