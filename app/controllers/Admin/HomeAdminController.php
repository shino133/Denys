<?php
class HomeAdminController extends AdminBaseController
{
  public static function index()
  {
    self::redirectAdmin('dashboard');
  }

  public static function dashboard()
  {
    ConstantsAdmin::homePage();

    AdminLoader::controller('TeamManagerAdminController');
    AdminLoader::model('UserModel');
    AdminLoader::model('PostModel');
    AdminLoader::model('CommentModel');
    AdminLoader::model('PostLikeModel');

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
