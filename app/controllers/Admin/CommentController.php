<?php
AdminLoader::model('CommentModel');

class CommentController extends AdminBaseController
{
  public function index()
  {
    ConstantsAdmin::commentPage();

    $commentData = CommentModel::read(columns: ['*']);

    $this->setData('commentData', $commentData);

    $this->renderAdmin('Comment/main');
  }
}