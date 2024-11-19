<?php
class DataValidator
{
  /**
   * Kiểm tra các trường trong mảng $data. Các trường trong $nullableFields có thể là null.
   *
   * @param array $data - Dữ liệu cần kiểm tra.
   * @param array $nullableFields - Danh sách các trường có thể là null.
   * @return bool - Trả về true nếu dữ liệu hợp lệ, false nếu không.
   */
  public static function check($data, $nullableFields = []): bool
  {
    foreach ($data as $key => $value) {
      // Kiểm tra nếu trường không cho phép null và giá trị là null hoặc rỗng
      if (!in_array($key, $nullableFields) && (is_null($value) || trim($value) === '')) {
        if (class_exists('ErrorHandler')) {
          ErrorHandler::set(message: "{$key} is required", statusCode: 400);
        }
        return false;
      }
    }
    return true;
  }
}