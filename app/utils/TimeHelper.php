<?php
class TimeHelper
{
  // Biến lưu trữ DateTimeZone
  private static ?DateTimeZone $timezone = null;

  // Biến lưu trữ DateTime hiện tại
  private static ?DateTime $currentTime = null;

  /**
   * Khởi tạo DateTimeZone và DateTime mặc định
   * @param string|null $timezone Tên timezone (TIMEZONE || UTC)
   */
  private static function initialize(string $timezone = TIMEZONE ?? 'UTC'): void
  {
    // Thiết lập timezone nếu chưa được khởi tạo
    if (self::$timezone === null) {
      $tzName = $timezone ?? 'UTC';
      self::$timezone = new DateTimeZone($tzName);
    }

    // Lưu thời gian hiện tại nếu chưa khởi tạo
    if (self::$currentTime === null) {
      self::$currentTime = new DateTime('now', self::$timezone);
    }
  }

  /**
   * Tính khoảng thời gian cách mốc thời gian mục tiêu
   * @param string $datetime Thời gian mục tiêu (định dạng 'Y-m-d H:i:s')
   * @param string|null $timezone Tên timezone (nếu null, sử dụng hằng TIMEZONE)
   * @return string Chuỗi kết quả dạng 'X phút trước' hoặc 'X giờ nữa'
   */
  public static function timeAgo(string $datetime, string $timezone = TIMEZONE ?? 'UTC'): string | false
  {
    if(!$datetime) return false;
    // Khởi tạo timezone và thời gian hiện tại
    self::initialize($timezone);

    // Tạo đối tượng thời gian mục tiêu với timezone
    $targetTime = new DateTime($datetime, self::$timezone);

    // Tính khoảng thời gian chênh lệch
    $interval = self::$currentTime->diff($targetTime);

    // Kiểm tra xem thời gian là quá khứ hay tương lai
    $isPast = self::$currentTime > $targetTime;

    // Xây dựng chuỗi kết quả
    if ($interval->y > 0) {
      $timeAgo = $interval->y . ' năm';
    } elseif ($interval->m > 0) {
      $timeAgo = $interval->m . ' tháng';
    } elseif ($interval->d > 0) {
      $timeAgo = $interval->d . ' ngày';
    } elseif ($interval->h > 0) {
      $timeAgo = $interval->h . ' giờ';
    } elseif ($interval->i > 0) {
      $timeAgo = $interval->i . ' phút';
    } else {
      $timeAgo = 'vài giây';
    }

    return $timeAgo . ($isPast ? ' trước' : ' nữa');
  }
}
