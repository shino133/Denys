<?php
include 'app/lib/AppLoader.php';

AppLoader::helper('master');
AppLoader::constant('master');

// Cấu hình thư mục cache tùy chỉnh và thời gian hết hạn mặc định
Cache::configure(__DIR__. '../cache', 3600);

// Hàm tiện ích để mã hóa
function encryptData($data)
{
  return Encryption::encrypt($data);
}

// Hàm tiện ích để giải mã
function decryptData($encryptedData)
{
  return Encryption::decrypt($encryptedData);
}