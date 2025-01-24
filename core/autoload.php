<?php
spl_autoload_register(function ($class) {
  // Danh sách base directories cho các namespace
  $baseDirs = [
    'App\\' => __DIR__.'/../app/',
    'Core\\' => __DIR__.'/',
  ];

  foreach ($baseDirs as $namespacePrefix => $baseDir) {
    // Kiểm tra nếu class bắt đầu bằng namespace prefix
    if (strpos($class, $namespacePrefix) === 0) {
      // Chuyển đổi namespace thành đường dẫn tệp
      $relativeClass = substr($class, strlen($namespacePrefix));
      $file = $baseDir.str_replace('\\', '/', $relativeClass).'.php';

      // Kiểm tra và require file nếu tồn tại
      if (file_exists($file)) {
        require_once $file;
        return;
      }
    }
  }

  // Nếu không tìm thấy class, bạn có thể xử lý lỗi hoặc ghi log tại đây
  throw new \Exception("Unable to load class: $class");
});

