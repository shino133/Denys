<?php
class Encryption
{
  private static $cipher = 'AES-256-CBC'; // Thuật toán mã hóa
  private static $key = APP_KEY ?? 'your_custom_secret_key';
  private static $ivLength; 

  public function __construct()
  {
    self::$ivLength = openssl_cipher_iv_length(self::$cipher);
  }

  // Hàm mã hóa dữ liệu
  public static function encrypt($data)
  {
    $iv = openssl_random_pseudo_bytes(self::$ivLength);
    $encryptedData = openssl_encrypt($data, self::$cipher, self::$key, 0, $iv);
    return base64_encode($iv . $encryptedData); // Ghép IV với dữ liệu mã hóa
  }

  // Hàm giải mã dữ liệu
  public static function decrypt($encryptedData)
  {
    $encryptedData = base64_decode($encryptedData);
    $iv = substr($encryptedData, 0, self::$ivLength);
    $encryptedData = substr($encryptedData, self::$ivLength);
    return openssl_decrypt($encryptedData, self::$cipher, self::$key, 0, $iv);
  }
}