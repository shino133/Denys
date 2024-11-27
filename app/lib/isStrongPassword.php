<?php
function isStrongPassword(string $password): bool
{
    // Kiểm tra độ dài của mật khẩu
    if (strlen($password) <= 8) {
        return false;
    }

    // Kiểm tra có ít nhất một chữ thường
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    // Kiểm tra có ít nhất một chữ hoa
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // Kiểm tra có ít nhất một chữ số
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    // Kiểm tra có ít nhất một ký tự đặc biệt
    if (!preg_match('/[\W_]/', $password)) {
        return false;
    }

    // Nếu tất cả các điều kiện trên đều đúng, mật khẩu mạnh
    return true;
}