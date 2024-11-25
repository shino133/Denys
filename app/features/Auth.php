<?php
class Auth extends Authentication
{
  // Phương thức cho username
  public static function setUser($username)
  {
    return self::set("username", $username);
  }

  public static function getUser()
  {
    return self::get("username");
  }

  public static function checkUser()
  {
    return self::check("username");
  }

  // Phương thức cho user_id
  public static function setUserId($user_id)
  {
    return self::set("user_id", $user_id);
  }

  public static function getUserId()
  {
    return self::get("user_id");
  }

  // Phương thức cho admin
  public static function setAdmin($username)
  {
    return self::set("admin", $username);
  }

  public static function getAdmin()
  {
    return self::get("admin");
  }

  public static function checkAdmin()
  {
    return self::check("admin");
  }

  // Phương thức cho login
  public static function checkLogin()
  {
    return self::checkUser() || self::checkAdmin();
  }

  // Phương thức cho csrf_token
  public static function setToken($secretKey = null)
  {
    AppLoader::lib('encryptData');
    $secretKey ??= "csrf_token_of_" . self::getUser();
    $csrf_token = encryptData($secretKey);

    return self::set("csrf_token", $csrf_token);
  }

  public static function getToken()
  {
    return self::get("csrf_token");
  }
}
