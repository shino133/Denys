<?php
function generateToken($length = 32)
{
  return bin2hex(openssl_random_pseudo_bytes($length / 2));
}