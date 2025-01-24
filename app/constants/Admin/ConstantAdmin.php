<?php
namespace App\Constants\Admin;

use App\Features\AdminLoader;

class ConstantAdmin
{
  // Admin pages
  public static function baseTag()
  {
    AdminLoader::constant('BaseTagAdmin');
  }

  public static function homePage()
  {
    self::baseTag();
    AdminLoader::constant('HomePage');
  }

  public static function userPage($name = null)
  {
    $name = isset($name) ? "/$name" : '';
    $path = 'UserPage' . $name;
    
    self::baseTag();
    AdminLoader::constant($path);
  }

  public static function postPage()
  {
    self::baseTag();
    AdminLoader::constant('PostPage');
  }

  public static function groupPage()
  {
    self::baseTag();
    AdminLoader::constant('GroupPage');
  }

  public static function commentPage()
  {
    self::baseTag();
    AdminLoader::constant('CommentPage');
  }

  public static function eventPage()
  {
    self::baseTag();
    AdminLoader::constant('EventPage');
  }

  public static function teamManagerPage()
  {
    self::baseTag();
    AdminLoader::constant('TeamManagerPage');
  }


  public static function settings()
  {
    self::baseTag();
    AdminLoader::constant('SettingsAdmin');
  }
}