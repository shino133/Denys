<?php
namespace App\Lib;

class FileUploader
{
  /**
   * Uploads an image file to the server.
   *
   * @param string $inputName The name of the file input field in the HTML form.
   * @param string $targetDir The directory where the uploaded file will be saved.
   * @param array $allowedExtensions Default is ["jpg", "jpeg", "png", "gif","webp"].
   * @param int $maxFileSize Default is 10MB.
   * @return array An associative array with keys:
   * - 'success': true if the upload is successful.
   * - 'filePath': the path to the uploaded file (if successful).
   * - 'message' or 'error': the result message or error details.
   * - 'error': the error message if the upload fails.
   */
  public static function uploadImage(
    $inputName,
    $targetDir,
    $allowedExtensions = ["jpg", "jpeg", "png", "gif", "webp"],
    $maxFileSize = 10 * 1024 * 1024
  ) {
    $action = function ($error, $success = false, $filePath = null, $fileName = null, $message = null) {
      return [
        'success' => $success,
        'filePath' => $filePath,
        'fileName' => $fileName,
        'message' => $message,
        'error' => $error
      ];
    };

    if (! isset($_FILES[$inputName])) {
      return $action('No file uploaded.');
    }

    $file = $_FILES[$inputName];
    $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (! in_array($fileExtension, $allowedExtensions)) {
      return $action('Invalid file type. Only '.implode(', ', $allowedExtensions).' files are allowed.');
    }

    if ($file["size"] > $maxFileSize) {
      return $action('File size exceeds the maximum limit of '.($maxFileSize / 1024 / 1024).'MB.');
    }

    // Random tên file
    $randomFileName = uniqid("img_", true).'.'.$fileExtension;
    $targetFilePath = rtrim($targetDir, '/').'/'.$randomFileName;

    // Tạo thư mục nếu chưa tồn tại
    if (! is_dir($targetDir)) {
      mkdir($targetDir, 0755, true);
    }

    if (! move_uploaded_file($file["tmp_name"], $targetFilePath)) {
      return $action('An error occurred while uploading the file.');
    }

    return $action(
      error: null,
      success: true,
      filePath: $targetFilePath,
      fileName: $randomFileName,
      message: 'File uploaded successfully.'
    );
  }
}
