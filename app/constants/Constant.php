<?php
namespace App\Constants;

use App\Features\AppLoader;

class Constant
{
  // User pages
  public static function baseTag()
  {
    AppLoader::constant('BaseTag');
  }

  public static function homePage()
  {
    self::baseTag();
    AppLoader::constant('HomePage');
  }

  public static function loginPage()
  {
    self::baseTag();
    AppLoader::constant('LoginPage');
  }

  public static function profilePage()
  {
    self::baseTag();
    AppLoader::constant('ProfilePage');
  }

  public static function settingPage()
  {
    self::baseTag();
    AppLoader::constant('SettingPage');
  }

  public static function searchPage()
  {
    self::baseTag();
    AppLoader::constant('SearchPage');
  }

  public static function sidebarHomePage()
  {
    return AppLoader::constant('SidebarHomePage');
  }

  public static function notFoundPage()
  {
    self::baseTag();
    AppLoader::constant('NotFoundPage');
  }
}