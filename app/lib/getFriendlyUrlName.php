<?php
AppLoader::lib('isValidUrl');
function getFriendlyUrlName($url)
{
  if (! isValidUrl($url)) {
    return $url; // Nếu không phải URL, trả về chuỗi ban đầu
  }

  // Phân tích URL thành các phần (domain, path, ...)
  $parsedUrl = parse_url($url);

  // Nếu URL không có "path", trả về domain
  if (! isset($parsedUrl['path']) || $parsedUrl['path'] === '/') {
    return $parsedUrl['host'];
  }

  // Loại bỏ dấu "/" ở đầu path và trả về
  return ltrim($parsedUrl['path'], '/');
}
