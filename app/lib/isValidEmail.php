<?php
function isValidEmail(string $email): bool
{
  // Sử dụng filter_var để kiểm tra email hợp lệ
  return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
