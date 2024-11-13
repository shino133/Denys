<?php
class Constants
{
  public static function baseTags()
  {
    AppLoader::constant('BaseTag');
  }

  public static function homePage()
  {
    self::baseTags();
    AppLoader::constant('HomePage');
  }

  public static function loginPage()
  {
    self::baseTags();
    AppLoader::constant('LoginPage');
  }
}