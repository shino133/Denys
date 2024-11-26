<?php
AppLoader::model('PostModel');

class HomeController extends BaseController
{
  private $postModel;

  public function __construct()
  {
    $this->postModel = new PostModel();
  }

  public function index()
  {
    if (Auth::checkLogin() == false) {
      $this->redirect('/user/login');
    }
    
    $posts = $this->postModel->getPosts();

    // set time ago
    AppLoader::util('TimeHelper');
    foreach ($posts as $key => $post) {
      $posts[$key]['timeAgo'] = TimeHelper::timeAgo($post['createdAt']);
    }

    $this->setData('user', Auth::get('username'));
    $this->setData('posts', $posts);

    Constants::homePage();
    $this->render('Home/main');
  }

}
