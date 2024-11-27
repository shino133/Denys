<?php

class Cache
{
  private static $cacheDir;
  private static $defaultExpiration = 3600;

  // Hàm khởi tạo tĩnh để thiết lập thư mục và thời gian hết hạn mặc định
  public static function configure($cacheDir = null, $defaultExpiration = 3600)
  {
    self::$cacheDir = $cacheDir ?? __DIR__;
    self::$defaultExpiration = $defaultExpiration;

    // Tạo thư mục cache nếu chưa tồn tại
    if (!is_dir(self::$cacheDir)) {
      mkdir(self::$cacheDir, 0777, true);
    }
  }

  // Lưu dữ liệu vào cache
  public static function set($key, $data, $expiration = null, $cacheFolder = null)
  {
    $expiration ??= self::$defaultExpiration;
    $cacheFile = self::getCacheFilePath(key: $key, cacheFolder: $cacheFolder);
    $cacheData = [
      'data' => $data,
      'expiration' => time() + $expiration,
    ];

    return file_put_contents($cacheFile, serialize($cacheData));
  }

  // Lấy dữ liệu từ cache
  public static function get($key, $cacheFolder = null)
  {
    $cacheFile = self::getCacheFilePath($key, $cacheFolder);

    if (!file_exists($cacheFile)) {
      return false;
    }

    $cacheData = unserialize(file_get_contents($cacheFile));

    // Kiểm tra thời gian hết hạn
    if (time() >= $cacheData['expiration']) {
      self::delete($key, $cacheFolder);// Xóa cache nếu đã hết hạn
      return false;
    }

    return $cacheData['data'];
  }

  // Xóa cache của một key cụ thể
  public static function delete($key, $cacheFolder = null)
  {
    $cacheFile = self::getCacheFilePath($key, $cacheFolder);
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
  private static function getCacheFilePath($key, $cacheFolder = null): string
  {
    self::createCacheFolder($cacheFolder);
    return self::$cacheDir . $cacheFolder . md5($key) . '.cache';
  }

  private static function createCacheFolder($cacheFolder)
  {
    if (isset($cacheFolder) == false) {
      return;
    }

    $cacheDir = self::$cacheDir . $cacheFolder;
    if (!is_dir($cacheDir)) {
      mkdir($cacheDir, 0777, true);
    }
  }
}
