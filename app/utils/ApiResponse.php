<?php
class ApiResponse
{
  public static function success($data = [])
  {
    header("Content-Type: application/json");
    echo json_encode(['status' => 'success', 'data' => $data]);
    exit;
  }

  public static function error($message, $code = 400)
  {
    header("Content-Type: application/json");
    http_response_code($code);
    echo json_encode(['status' => 'error', 'message' => $message]);
    exit;
  }
}
