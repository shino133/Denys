<?php
AdminLoader::model('PostModel');

class PostController extends AdminBaseController
{
  public function index() {
    ConstantsAdmin::postPage();

    $postData = PostModel::getPosts(limit: null);

    $this->setData('postData', $postData);

    $this->renderAdmin('Post/main');
  }
}