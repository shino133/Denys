<?php
namespace App\Utils;

class ApiHandler
{
  /**
   * Lấy dữ liệu từ request của người dùng
   *
   * @return array|false Dữ liệu đã parse hoặc false nếu không hợp lệ
   */
  public static function getRequestData()
  {
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

    // Nếu request là JSON
    if (stripos($contentType, 'application/json') !== false) {
      $input = file_get_contents('php://input');
      $data = json_decode($input, true);
      return json_last_error() === JSON_ERROR_NONE ? $data : false;
    }

    // Nếu request là form-data hoặc x-www-form-urlencoded
    if (stripos($contentType, 'application/x-www-form-urlencoded') !== false || stripos($contentType, 'multipart/form-data') !== false) {
      return $_POST;
    }

    // Trường hợp không hỗ trợ
    return false;
  }

  /**
   * Trả về phản hồi JSON cho client
   *
   * @param mixed $data Dữ liệu để trả về
   * @param int $statusCode Mã trạng thái HTTP (mặc định là 200)
   * @return void
   */
  public static function sendJson($data, int $statusCode = 200)
  {
    // Thiết lập header
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');

    // Trả về dữ liệu dưới dạng JSON
    echo json_encode($data);
    exit;
  }

  /**
   * Trả về phản hồi lỗi cho client
   *
   * @param string $message Thông báo lỗi
   * @param int $statusCode Mã trạng thái HTTP (mặc định là 400)
   * @return void
   */
  public static function sendError(string $message, int $statusCode = 400)
  {
    self::sendJson(['error' => $message], $statusCode);
  }

  /**
   * Trả về phản hồi HTML cho client
   *
   * @param string $html Nội dung HTML
   * @param int $statusCode Mã trạng thái HTTP (mặc định là 200)
   * @return void
   */
  public static function sendHtmlResponse(string $html, int $statusCode = 200)
  {
    // Thiết lập mã trạng thái HTTP
    http_response_code($statusCode);

    // Thiết lập header để trả về HTML
    header('Content-Type: text/html; charset=utf-8');

    // In nội dung HTML
    echo $html;
    exit;
  }
}

