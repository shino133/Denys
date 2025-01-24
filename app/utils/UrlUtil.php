<?php

namespace App\Utils;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Url;

class UrlUtil
{
  /**
   * Kiểm tra xem URL có hợp lệ hay không
   *
   * @param string $url
   * @return bool
   */
  public static function isValid(string $url): bool
  {
    $validator = Validation::createValidator();
    $constraint = new Url();

    $violations = $validator->validate($url, $constraint);

    return count($violations) === 0;
  }

  /**
   * Kiểm tra URL hợp lệ và trả về lỗi nếu không
   *
   * @param string $url
   * @return array|string
   */
  public static function validateUrl(string $url): array|string
  {
    $validator = Validation::createValidator();
    $constraint = new Url();

    $violations = $validator->validate($url, $constraint);

    if (count($violations) === 0) {
      return true;
    }

    // Trả về danh sách lỗi
    $errors = [];
    foreach ($violations as $violation) {
      $errors[] = $violation->getMessage();
    }

    return $errors;
  }

  /**
   * Lấy tên thân thiện từ URL
   *
   * @param string $url
   * @return string
   */
  public static function getFriendlyUrlName(string $url): string
  {
    if (! self::isValid($url)) {
      return $url; // Nếu không phải URL, trả về chuỗi ban đầu
    }

    // Phân tích URL thành các phần (domain, path, ...)
    $parsedUrl = parse_url($url);

    // Nếu URL không có "path", trả về domain
    if (! isset($parsedUrl['path']) || $parsedUrl['path'] === '/') {
      return $parsedUrl['host'];
    }

    // Loại bỏ dấu "/" ở đầu path và trả về
    return ltrim($parsedUrl['path'], '/');
  }
}
