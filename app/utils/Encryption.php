<?php
namespace App\Utils;

class Encryption
{
  private static $cipher = 'AES-256-CBC';
  private static $key = APP_KEY ?? null;
  private static $ivLength = null;

  // Khởi tạo độ dài IV ngay khi khai báo
  public static function initialize(): void
  {
    if (self::$ivLength === null) {
      self::$ivLength = openssl_cipher_iv_length(self::$cipher);
    }
  }

  // Hàm mã hóa dữ liệu
  public static function encrypt($data): string
  {
    self::initialize();

    $iv = openssl_random_pseudo_bytes(self::$ivLength);
    $encryptedData = openssl_encrypt($data, self::$cipher, self::$key, 0, $iv);
    return base64_encode($iv . $encryptedData); // Ghép IV với dữ liệu mã hóa
  }

  // Hàm giải mã dữ liệu
  public static function decrypt($encryptedData): bool|string
  {
    self::initialize();

    $encryptedData = base64_decode($encryptedData);
    $iv = substr($encryptedData, 0, self::$ivLength);
    $encryptedData = substr($encryptedData, self::$ivLength);
    return openssl_decrypt($encryptedData, self::$cipher, self::$key, 0, $iv);
  }
}