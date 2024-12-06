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
  public static function set($key, $data, $expiration = 3600, $cacheFolder = null)
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
    $items = glob(self::$cacheDir . '/*', GLOB_MARK); // Lấy danh sách tất cả tệp và thư mục (GLOB_MARK thêm dấu '/' vào cuối nếu là thư mục)

    foreach ($items as $item) {
      if (is_dir($item)) {
        // Nếu là thư mục, gọi đệ quy để xóa nội dung bên trong
        self::deleteDirectory($item);
      } elseif (is_file($item) && str_ends_with($item, '.cache')) {
        // Nếu là tệp và có đuôi '.cache', thì xóa
        unlink($item);
      }
    }
  }

  // Hàm phụ để xóa thư mục và nội dung bên trong
  private static function deleteDirectory(string $dir)
  {
    $files = glob($dir . '*', GLOB_MARK); // Lấy danh sách nội dung (thêm '/' nếu là thư mục)

    foreach ($files as $file) {
      if (is_dir($file)) {
        // Nếu là thư mục con, gọi đệ quy
        self::deleteDirectory($file);
      } elseif (is_file($file) && str_ends_with($file, '.cache')) {
        // Nếu là tệp và có đuôi '.cache', thì xóa
        unlink($file);
      }
    }

    // Chỉ xóa thư mục nếu rỗng
    if (count(glob($dir . '*', GLOB_MARK)) === 0) {
      rmdir($dir);
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
