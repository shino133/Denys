<?php

namespace App\Utils;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EmailUtil
{
  /**
   * Validate email address.
   *
   * @param string $email The email address to validate.
   * @return bool True if the email is valid, false otherwise.
   */
  public static function isValid(string $email): bool
  {
    $validator = Validation::createValidator();

    $constraints = [
      new NotBlank(), // Không được để trống
      new Email(),    // Phải là email hợp lệ
      new Length(['max' => 255]) // Giới hạn độ dài email
    ];

    $violations = $validator->validate($email, $constraints);

    // Nếu không có lỗi, email là hợp lệ
    return count($violations) === 0;
  }

  /**
   * Extract domain from email address.
   *
   * @param string $email The email address.
   * @return string|null The domain of the email or null if invalid.
   */
  public static function getDomain(string $email): ?string
  {
    if (! self::isValid($email)) {
      return null;
    }

    $parts = explode('@', $email);
    return $parts[1] ?? null;
  }
}
