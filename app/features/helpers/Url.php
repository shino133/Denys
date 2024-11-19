<?php
class Url
{
  public static $url;
  public static $query_string;

  public static function set($url, $query_string = null)
  {
    self::$url = $url;
    self::$query_string = $query_string;
  }

  public static function setQueryString($query_array)
  {
    foreach ($query_array as $key => $value) {
      self::$query_string .= $key . '=' . $value . '&';
    }
  }

  public static function setUrl($url)
  {
    self::$url = $url;
  }

  public static function get()
  {
    return self::$url . '?' . self::$query_string;
  }

  public static function setNofi($msg, $status){
    self::$query_string .= "msg=$msg&status=$status&";
  }
}