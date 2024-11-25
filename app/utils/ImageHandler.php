<?php

class ImageHandler
{
  // Đường dẫn mặc định để lưu trữ ảnh
  private static $uploadDir = 'uploads/images/';

  /**
   * Đặt đường dẫn lưu trữ ảnh
   *
   * @param string $dir
   */
  public static function setUploadDir(string $dir): void
  {
    self::$uploadDir = rtrim($dir, '/') . '/';
    if (!is_dir(self::$uploadDir)) {
      mkdir(self::$uploadDir, 0777, true);
    }
  }

  /**
   * Tải ảnh lên server
   *
   * @param array $file Tệp tin từ $_FILES
   * @return string|false URL của ảnh đã tải lên hoặc false nếu thất bại
   */
  public static function upload(array $file)
  {
    // Kiểm tra lỗi tải lên
    if ($file['error'] !== UPLOAD_ERR_OK) {
      return false;
    }

    // Kiểm tra loại file
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
      return false;
    }

    // Tạo tên tệp tin duy nhất
    $fileName = uniqid('img_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    $filePath = self::$uploadDir . $fileName;

    // Di chuyển file vào thư mục upload
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
      return self::getImageUrl($fileName);
    }

    return false;
  }

  /**
   * Lấy URL của một ảnh đã lưu
   *
   * @param string $fileName Tên file ảnh
   * @return string URL đầy đủ của ảnh
   */
  public static function getImageUrl(string $fileName): string
  {
    $baseUrl = self::getBaseUrl();
    return $baseUrl . '/' . self::$uploadDir . $fileName;
  }

  /**
   * Lấy Base URL của ứng dụng
   *
   * @return string
   */
  private static function getBaseUrl(): string
  {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
    return $protocol . '://' . $host . $scriptDir;
  }
}
