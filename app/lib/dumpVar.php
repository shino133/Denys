<?php

namespace App\Lib;

class DumpVar
{
  /**
   * Hiển thị thông tin biến và dừng hoặc tiếp tục thực thi.
   *
   * @param mixed $var Biến cần dump.
   * @param bool $allowContinue Có cho phép tiếp tục thực thi không.
   * @param bool $allowWrap Có cho phép wrap nội dung dài không.
   */
  public static function dump($var, bool $allowContinue = false, bool $allowWrap = true): void
  {
    // Lấy thông tin stack trace để xác định vị trí hàm được gọi
    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
    $callerInfo = $backtrace[0];

    // Hiển thị CSS cho pre
    echo '<style>
            pre {
                max-width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 20px;
                line-height: 1.5;
                '.($allowWrap ? 'word-wrap: break-word;' : '').'
            }
        </style>';

    // Hiển thị vị trí được gọi và nội dung biến
    echo '<pre>';
    echo "Called at: {$callerInfo['file']} on line {$callerInfo['line']}\n\n";

    echo "Dumped variable:\n";
    if (is_array($var) || is_object($var)) {
      echo json_encode($var, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
      var_dump($var);
    }
    echo '</pre>';

    // Dừng hoặc tiếp tục thực thi
    if (! $allowContinue) {
      die();
    }
  }
}
