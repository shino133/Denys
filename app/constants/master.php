<?php
class Constants
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


  // Admin pages
  public static function baseTagAdmin()
  {
    AppLoader::constant('Admin/BaseTagAdmin');
  }

  public static function homeAdmin()
  {
    self::baseTagAdmin();
    AppLoader::constant('Admin/HomeAdmin');
  }

  public static function settingsAdmin()
  {
    self::baseTagAdmin();
    AppLoader::constant('Admin/SettingsAdmin');
  }
}