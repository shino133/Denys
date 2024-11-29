<?php
class TimeHelper
{
  // Biến lưu trữ DateTimeZone
  private static ?DateTimeZone $timezone = null;

  // Biến lưu trữ DateTime hiện tại
  private static ?DateTime $currentTime = null;

  // Định nghĩa các hệ số chuyển đổi
  private static $timeUnits = [
    's' => 1,               // giây
    'm' => 60,              // phút
    'h' => 3600,            // giờ
    'd' => 86400,           // ngày
    'w' => 604800           // tuần
  ];

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
  public static function timeAgo(string $datetime, string $timezone = TIMEZONE ?? 'UTC'): string|false
  {
    if (!$datetime)
      return false;
    // Khởi tạo timezone và thời gian hiện tại
    self::initialize($timezone);

    // Tạo đối tượng thời gian mục tiêu với timezone
    $targetTime = new DateTime($datetime, self::$timezone);

    // Tính khoảng thời gian chênh lệch
    $interval = self::$currentTime->diff($targetTime);

    // Kiểm tra xem thời gian là quá khứ hay tương lai
    $isPast = self::$currentTime > $targetTime;

    // Xây dựng chuỗi kết quả
    $years = $interval->y;
    $months = $interval->m;
    $days = $interval->d;
    $hours = $interval->h;
    $minutes = $interval->i;

    $timeAgo = match (true) {
      $years > 0 => "$years năm",
      $months > 0 => "$months tháng",
      $days > 0 => "$days ngày",
      $hours > 0 => "$hours giờ",
      $minutes > 0 => "$minutes phút",
      default => 'vài giây',
    };

    return $timeAgo . ($isPast ? ' trước' : ' nữa');
  }


  /**
   * Chuyển đổi chuỗi thời gian thành giây.
   *
   * @param string $timeString Chuỗi thời gian, ví dụ "1d", "2h", "30m".
   * @return int|null Trả về số giây hoặc null nếu định dạng không hợp lệ.
   */
  public static function toSeconds($timeString)
  {
    // Kiểm tra chuỗi đầu vào có hợp lệ không (dạng số + ký tự)
    if (preg_match('/^(\d+)([smhdw])$/', $timeString, $matches)) {
      $value = (int) $matches[1];          // Lấy phần số
      $unit = $matches[2];                // Lấy phần đơn vị thời gian
      return $value * self::$timeUnits[$unit];
    }
    return null; // Trả về null nếu định dạng không hợp lệ
  }

  /**
   * Lấy ngày từ chuỗi thời gian với định dạng tùy chọn
   *
   * @param string $datetime Thời gian đầu vào (định dạng 'Y-m-d H:i:s')
   * @param string $format Định dạng đầu ra (mặc định 'Y-m-d')
   * @return string|null Ngày/giờ theo định dạng hoặc null nếu không hợp lệ
   */
  public static function formatDate(string $datetime, string $format = 'Y-m-d'): ?string
  {
    try {
      $date = new DateTime($datetime);
      return $date->format($format);
    } catch (Exception $e) {
      return null;
    }
  }
}
