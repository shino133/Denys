<?php

class CacheCore
{
  private static $cacheDir;
  private static $defaultExpiration = 3600;

  // Hàm khởi tạo tĩnh để thiết lập thư mục và thời gian hết hạn mặc định
  public static function configure($cacheDir = null, $defaultExpiration = 3600)
  {
    self::$cacheDir = $cacheDir ?? __DIR__ ;
    self::$defaultExpiration = $defaultExpiration;

    // Tạo thư mục cache nếu chưa tồn tại
    // if (!is_dir(self::$cacheDir)) {
    //   mkdir(self::$cacheDir, 0777, true);
    // }
  }

  // Lưu dữ liệu vào cache
  public static function set($key, $data, $expiration = null)
  {
    $expiration = $expiration ?? self::$defaultExpiration;
    $cacheFile = self::getCacheFilePath($key);
    $cacheData = [
      'data' => $data,
      'expiration' => time() + $expiration,
    ];

    file_put_contents($cacheFile, serialize($cacheData));
  }

  // Lấy dữ liệu từ cache
  public static function get($key)
  {
    $cacheFile = self::getCacheFilePath($key);

    if (!file_exists($cacheFile)) {
      return false;
    }

    $cacheData = unserialize(file_get_contents($cacheFile));

    // Kiểm tra thời gian hết hạn
    if (time() < $cacheData['expiration']) {
      return $cacheData['data'];
    }

    // Xóa cache nếu đã hết hạn
    self::delete($key);
    return false;
  }

  // Xóa cache của một key cụ thể
  public static function delete($key)
  {
    $cacheFile = self::getCacheFilePath($key);
    if (file_exists($cacheFile)) {
      unlink($cacheFile);
    }
  }

  // Xóa toàn bộ dữ liệu cache
  public static function clear()
  {
    $files = glob(self::$cacheDir . '/*.cache');
    foreach ($files as $file) {
      unlink($file);
    }
  }

  // Lấy đường dẫn file cache dựa trên key
  private static function getCacheFilePath($key)
  {
    return self::$cacheDir . '/' . md5($key) . '.cache';
  }
}
