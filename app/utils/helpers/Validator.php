<?php
namespace App\Utils\Helpers;

class Validator
{
  /**
   * Kiểm tra chuỗi có rỗng hay không
   */
  public static function isEmpty($value)
  {
    return empty(trim($value));
  }

  /**
   * Kiểm tra độ dài chuỗi
   */
  public static function minLength($value, $min)
  {
    return strlen($value) >= $min;
  }

  public static function maxLength($value, $max)
  {
    return strlen($value) <= $max;
  }

  /**
   * Kiểm tra định dạng email
   */
  public static function isEmail($email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
  }

  /**
   * Kiểm tra số nguyên
   */
  public static function isInteger($value)
  {
    return filter_var($value, FILTER_VALIDATE_INT) !== false;
  }

  /**
   * Kiểm tra số dương
   */
  public static function isPositiveNumber($value)
  {
    return self::isInteger($value) && $value > 0;
  }

  /**
   * Kiểm tra độ dài chuỗi trong khoảng min và max
   */
  public static function lengthBetween($value, $min, $max)
  {
    $length = strlen($value);
    return $length >= $min && $length <= $max;
  }

  /**
   * Kiểm tra định dạng URL
   */
  public static function isUrl($url)
  {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
  }

  /**
   * Kiểm tra số điện thoại
   */
  public static function isPhoneNumber($phone)
  {
    return preg_match('/^[0-9]{10,15}$/', $phone);
  }

  /**
   * Kiểm tra chuỗi chỉ chứa các ký tự chữ cái
   */
  public static function isAlphabet($value)
  {
    return preg_match('/^[a-zA-Z]+$/', $value);
  }

  /**
   * Kiểm tra chuỗi chỉ chứa chữ và số
   */
  public static function isAlphanumeric($value)
  {
    return preg_match('/^[a-zA-Z0-9]+$/', $value);
  }

  /**
   * Kiểm tra nếu giá trị nằm trong danh sách cho phép
   */
  public static function inArray($value, $array)
  {
    return in_array($value, $array);
  }
}
