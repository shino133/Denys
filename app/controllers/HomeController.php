<?php
class HomeController extends BaseController
{
  private $postModel;

  public function __construct()
  {
    // $this->postModel = new PostModel();
  }

  public function index()
  {
    if (Auth::checkLogin() == false) {
      $this->redirect('/user/login');
    }
    
    AppLoader::controller('PostController');
    $posts = (new PostController())->getNewPosts();

    $this->setData('userData', Auth::getUser());
    $this->setData('posts', $posts);

    Constants::homePage();
    $this->render('Home/main');
  }

}
