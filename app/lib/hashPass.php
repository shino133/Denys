<?php
function hashPass($password) {
  return password_hash($password, PASSWORD_DEFAULT);
}

function checkPass($password, $hash) {
  return password_verify($password, $hash);
}