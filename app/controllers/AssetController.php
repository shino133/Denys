<?php
namespace App\Controllers;

use App\Features\AppLoader;
use App\Lib\FileUploader;

class AssetController
{
  protected static $basePath = __DIR__.'/../';

  public static function serveFile($filePath)
  {
    // Kiểm tra file có tồn tại không
    if (! file_exists($filePath)) {
      header("HTTP/1.0 404 Not Found");
      echo "File not found.";
      return;
    }

    // Lấy loại MIME dựa trên phần mở rộng của file
    $mimeType = mime_content_type($filePath);

    // Gửi tiêu đề HTTP để xác định loại nội dung
    header("Content-Type: $mimeType");
    header("Content-Length: ".filesize($filePath));

    // Gửi nội dung file
    readfile($filePath);
    exit;
  }

  public static function getImage($fileName)
  {
    $imagePath = self::$basePath."assets/img/$fileName";
    self::serveFile($imagePath);
  }

  public static function getUpload($fileName)
  {
    $filePath = self::$basePath."assets/uploads/$fileName";
    self::serveFile($filePath);
  }

  public static function getJs($fileName)
  {
    $jsPath = self::$basePath."assets/js/$fileName";
    self::serveFile($jsPath);
  }

  public static function getCss($fileName)
  {
    $cssPath = self::$basePath."assets/css/$fileName";
    self::serveFile($cssPath);
  }

  public static function upImage($inputName, $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'], $maxFileSize = 5, $pathToSave = null)
  {

    $pathToSave ??= "assets/uploads/";
    $path = self::$basePath.$pathToSave;

    return FileUploader::uploadImage(
      inputName: $inputName,
      targetDir: $path,
      allowedExtensions: $allowedExtensions,
      maxFileSize: $maxFileSize * 1024 * 1024);
  }
}
