<?php
namespace App\Controllers\Admin;

use App\Constants\Admin\ConstantAdmin;
use App\Models\CommentModel;

class CommentAdminController extends AdminBaseController
{
  public static function index()
  {
    ConstantAdmin::commentPage();

    $commentData = CommentModel::read(columns: ['*']);

    self::setData('commentData', $commentData);

    self::renderAdmin('Comment/main');
  }
}