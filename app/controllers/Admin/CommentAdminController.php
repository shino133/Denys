<?php
AdminLoader::model('CommentModel');

class CommentAdminController extends AdminBaseController
{
  public static function index()
  {
    ConstantsAdmin::commentPage();

    $commentData = CommentModel::read(columns: ['*']);

    self::setData('commentData', $commentData);

    self::renderAdmin('Comment/main');
  }
}