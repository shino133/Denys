<?php
class Auth extends Authentication
{
  // Phương thức cho username
  public static function setUser($userData)
  {
    return self::set("user", $userData);
  }

  public static function getUser()
  {
    return self::get("user");
  }

  public static function checkUser()
  {
    return self::check("user");
  }

  // Phương thức cho admin
  public static function setAdmin($userData)
  {
    return self::set("admin", $userData);
  }

  public static function getAdmin()
  {
    return self::get("admin");
  }

  // Phương thức cho Admin Editor
  public static function setAdminEditor($userData)
  {
    return self::set("adminEditor", $userData);
  }

  public static function getAdminEditor()
  {
    return self::get("adminEditor");
  }

  public static function checkAdminEditor()
  {
    return self::check("adminEditor");
  }

  public static function checkAdmin()
  {
    return self::check("admin") || self::check("adminEditor");
  }

  // Phương thức cho login
  public static function checkLogin()
  {
    return self::checkUser() || self::checkAdmin();
  }

  // Phương thức cho csrf_token
  public static function setToken($length = 32)
  {
    AppLoader::lib('generateToken');
    $csrf_token = generateToken($length);

    return self::set("csrf_token", $csrf_token);
  }

  public static function getToken()
  {
    return self::get("csrf_token");
  }

  public static function checkToken()
  {
    return self::check("csrf_token");
  }

  public static function destroyToken()
  {
    return self::destroy("csrf_token");
  }

  public static function setLoginTime($time = 'now'){
    $time = $time === 'now' ? time() : $time;
    return self::set('login_time', $time);
  }

  public static function getLoginTime(){
    return self::get('login_time');
  }

  public static function setActiveUser($userName)
  {
    Cache::set($userName , ['status' => 'active'], 60, 'users/');
  }
}
