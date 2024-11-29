<?php
class ConstantsAdmin
{
  // Admin pages
  public static function baseTag()
  {
    AdminLoader::constant('BaseTagAdmin');
  }

  public static function home()
  {
    self::baseTag();
    AdminLoader::constant('HomeAdmin');
  }

  public static function settings()
  {
    self::baseTag();
    AdminLoader::constant('SettingsAdmin');
  }
}