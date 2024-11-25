<?php
function dumpVar($var)
{
  // Lấy thông tin stack trace để xác định vị trí hàm được gọi
  $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
  $callerInfo = $backtrace[0];

  // Hiển thị vị trí được gọi
  echo '<pre style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 20px; line-height: 1.5;">';
  echo "Called at: {$callerInfo['file']} on line {$callerInfo['line']}\n\n";

  // Chuyển đổi dữ liệu sang JSON (nếu được)
  echo "Dumped variable:\n";
  if (is_array($var) || is_object($var)) {
    echo json_encode($var, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  } else {
    var_dump($var);
  }

  echo '</pre>';
  die();
}