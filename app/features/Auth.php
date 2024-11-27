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
