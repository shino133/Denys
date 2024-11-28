<?php

class AssetController
{
  public static function serveFile($filePath)
  {
    // Kiểm tra file có tồn tại không
    if (!file_exists($filePath)) {
      header("HTTP/1.0 404 Not Found");
      echo "File not found.";
      return;
    }

    // Lấy loại MIME dựa trên phần mở rộng của file
    $mimeType = mime_content_type($filePath);

    // Gửi tiêu đề HTTP để xác định loại nội dung
    header("Content-Type: $mimeType");
    header("Content-Length: " . filesize($filePath));

    // Gửi nội dung file
    readfile($filePath);
    exit;
  }

  public static function getImage($fileName)
  {
    $imagePath = AppLoader::getPath("assets/img/$fileName");
    self::serveFile($imagePath);
  }

  public static function getUpload($fileName)
  {
    $filePath = AppLoader::getPath("assets/uploads/$fileName");
    self::serveFile($filePath);
  }

  public static function getJs($fileName)
  {
    $jsPath = AppLoader::getPath("assets/js/$fileName");
    self::serveFile($jsPath);
  }

  public static function getCss($fileName)
  {
    $cssPath = AppLoader::getPath("assets/css/$fileName");
    self::serveFile($cssPath);
  }

  public static function upImage($inputName, $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'], $maxFileSize = 10)
  {
    AppLoader::lib('uploadImage');

    $path = AppLoader::getPath("assets/uploads/");

    return uploadImage(inputName: $inputName, targetDir: $path, allowedExtensions: $allowedExtensions, maxFileSize: $maxFileSize * 1024 * 1024);
  }
}
