<?php
function dumpVar($var, $allowContinue = false, $allowWrap = true)
{
  // Lấy thông tin stack trace để xác định vị trí hàm được gọi
  $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
  $callerInfo = $backtrace[0];
  ?>
  <style>
    pre {
      max-width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 20px;
      line-height: 1.5;
      <?php if ($allowWrap) { ?>
      word-wrap: break-word;
      <?php } ?>
    }
  </style>
  <?php
  // Hiển thị vị trí được gọi
  echo '<pre>';
  echo "Called at: {$callerInfo['file']} on line {$callerInfo['line']}\n\n";

  // Chuyển đổi dữ liệu sang JSON (nếu được)
  echo "Dumped variable:\n";
  if (is_array($var) || is_object($var)) {
    echo json_encode($var, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  } else {
    var_dump($var);
  }

  echo '</pre>';

  if ($allowContinue)
    return;
  die();
}