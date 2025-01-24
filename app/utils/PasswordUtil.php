<?php

namespace App\Utils;

use Illuminate\Hashing\BcryptHasher;
use ZxcvbnPhp\Zxcvbn;

class PasswordUtil
{
  // Tạo instance cho hashing và kiểm tra password strength
  private static BcryptHasher $hasher;
  private static Zxcvbn $zxcvbn;

  // Khởi tạo hasher và zxcvbn
  public static function init(): void
  {
    if (! isset(self::$hasher)) {
      self::$hasher = new BcryptHasher();
    }

    if (! isset(self::$zxcvbn)) {
      self::$zxcvbn = new Zxcvbn();
    }
  }

  /**
   * Hash password.
   *
   * @param string $password
   * @return string
   */
  public static function hash(string $password): string
  {
    self::init();
    return self::$hasher->make($password);
  }

  /**
   * Verify password.
   *
   * @param string $password
   * @param string $hashedPassword
   * @return bool
   */
  public static function verify(string $password, string $hashedPassword): bool
  {
    self::init();
    return self::$hasher->check($password, $hashedPassword);
  }

  /**
   * Check password strength.
   *
   * @param string $password
   * @return array
   */
  public static function checkStrength(string $password): array
  {
    self::init();
    $result = self::$zxcvbn->passwordStrength($password);

    return [
      'score' => $result['score'], // Score: 0 (yếu) - 4 (mạnh)
      'feedback' => $result['feedback']['suggestions'] ?? [],
    ];
  }

  /**
   * Check if the password is strong.
   *
   * @param string $password
   * @param int $minScore Minimum score to consider as "strong" (default: 3)
   * @return bool
   */
  public static function isStrong(string $password, int $minScore = 3): bool
  {
    $strength = self::checkStrength($password);
    return $strength['score'] >= $minScore;
  }
}
