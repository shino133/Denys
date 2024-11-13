<?php
function apiRender($filePath, $data = [])
{
  // Bắt đầu bộ đệm
  ob_start();

  // Truyền biến vào file template
  extract($data);
  if (class_exists('AppLoader')) {
    AppLoader::view($filePath, $data);
  } else {
    include $filePath;
  }

  // Lấy nội dung từ bộ đệm và xóa bộ đệm
  return ob_get_clean();
}