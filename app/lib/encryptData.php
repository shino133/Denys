<?php
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