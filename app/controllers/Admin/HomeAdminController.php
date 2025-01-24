<?php
namespace App\Controllers\Admin;

use App\Constants\Admin\ConstantAdmin;
use App\Models\CommentModel;
use App\Models\PostLikeModel;
use App\Models\PostModel;
use App\Models\UserModel;

class HomeAdminController extends AdminBaseController
{
  public static function index()
  {
    self::redirectAdmin('dashboard');
  }

  public static function dashboard()
  {
    ConstantAdmin::homePage();

    // Set data for View
    $statisticalData = [
      'userCount' => UserModel::count(),
      'postCount' => PostModel::count(),
      'commentCount' => CommentModel::count(),
      'likeCount' => PostLikeModel::count()
    ];

    $teamManagerData = TeamManagerAdminController::setTableData();

    self::setAllData(data: array_merge(
      $statisticalData,
      $teamManagerData
    ));

    self::renderAdmin('Home/main');
  }

}
