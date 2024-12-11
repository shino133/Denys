<?php
function htmlToString(callable $callback) : string
{
  // Bắt đầu bộ đệm
  ob_start();

  // Gọi hàm được truyền vào
  $callback();

  // Lấy nội dung từ bộ đệm và xóa bộ đệm
  return ob_get_clean();
}
