<?php

class TimeConverter
{
    // Định nghĩa các hệ số chuyển đổi
    private static $timeUnits = [
        's' => 1,               // giây
        'm' => 60,              // phút
        'h' => 3600,            // giờ
        'd' => 86400,           // ngày
        'w' => 604800           // tuần
    ];

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
            $value = (int)$matches[1];          // Lấy phần số
            $unit = $matches[2];                // Lấy phần đơn vị thời gian
            return $value * self::$timeUnits[$unit];
        }
        return null; // Trả về null nếu định dạng không hợp lệ
    }
}
