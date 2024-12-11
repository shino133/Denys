<?php
AppLoader::model('PostModel');
class PostController extends BaseController
{
  private $postModel;

  public static function addPost()
  {
    AppLoader::util('DataValidator');

    // Action reverse
    Action::set('reverse', function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      self::reverse(Url::getQueryString());
    });

    // Action add post
    Action::set('addPost', function ($data) {
      $res = PostModel::addPost($data);
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
      $uploadImage = AssetController::upImage("post_image");
    }

    if (isset($uploadImage['success']) && $uploadImage['success'] === false) {
      Action::run('reverse', 'Lỗi tải ảnh', 'error');
    }

    $data['media_url'] = $uploadImage['fileName'] ?? '';

    // Redirect
    Action::run('addPost', $data);
  }

  public static function postPage($postId){
    self::setData('posts', self::getPostById($postId));

    Constants::homePage();
    self::render('Post/main');
  }
  
  public static function getPostById($postId , $conditions = ['status' => 'active'])
  {
    Action::set('reverse', function ($msg, $status = 'error') {
      Url::setNofi($msg, $status);
      self::reverse(Url::getQueryString());
    });

    // Set action get comments
    Action::set('getComments', function () use ($postId) {
      AppLoader::controller('CommentController');
      return CommentController::getCommentByPostId($postId);
    });

    // Get post 
    $conditions['id'] = $postId;
    $posts = PostModel::getPosts(
      orderBy: null,
      conditions: $conditions,
      limit: 1,
    );

    if (! $posts) {
      Action::run('reverse', 'Không tìm tháy bài viết', 'error');
    }

    // Get comments
    $postId = $posts[0]['post_id'];
    $posts[0]['comments'] = Action::run('getComments');

    //Get isLikedByCurrentUser
    $posts[0]['isLikedByCurrentUser'] = $posts[0]['isLikedByCurrentUser'] == 1;

    return $posts;
  }

  public static function getNewPosts($limit = 10, $useCache = true, $offset = 0)
  {
    $timeResetCache = 10; // seconds

    Action::set('getNewPosts', function () use ($limit, $offset) {
      return PostModel::getPosts('created_at', ['status' => "active"], $limit, $offset);
    });

    //WHEN: Don't use cache
    if ($useCache == false) {
      return Action::run('getNewPosts');
    }

    // Get from cache
    $posts = Cache::get('newPosts', 'posts/');
    if (isset($posts) && $posts !== false) {
      return $posts;
    }

    // Get from database
    $posts = Action::run('getNewPosts');
    if ($posts == false) {
      return [];
    }

    // Save to cache
    Cache::set(
      key: 'newPosts',
      data: $posts,
      expiration: $timeResetCache,
      cacheFolder: 'posts/'
    );
    return $posts;
  }

  public static function renderNewPosts($offset = 0, $limit = 10)
  {
    $offset = max(0, (int) $offset) * $limit;

    $posts = self::getNewPosts(
      limit: $limit,
      useCache: false,
      offset: $offset
    );

    return AppLoader::component("Post/NewPosts", ['posts' => $posts]);
  }
}