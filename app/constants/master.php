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
}