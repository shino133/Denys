<?php
use App\Utils\Helpers\Script;

// Thay thế 'your_api_key' bằng API key của bạn
$apiKey = API_WEATHER_KEY;
$city = API_WEATHER_CITY; // Tên thành phố bạn muốn lấy dữ liệu

// Tạo URL yêu cầu
$url = 'http://api.weatherapi.com/v1/current.json?key=' . $apiKey . '&q=' . $city;

// Gửi yêu cầu và lấy dữ liệu
$response = file_get_contents($url);
$data = json_decode($response, true);

// Truy xuất dữ liệu cần thiết
$temperature = $data['current']['temp_c'];
$city = $data['location']['name'];

// Lưu dữ liệu vào một biến để truyền cho JavaScript
$weatherData = json_encode(['temperature' => $temperature, 'city' => $city]);

$content = "const weatherData = $weatherData ;
  document.getElementById('temperature').textContent = weatherData.temperature;
  document.getElementById('city').textContent = weatherData.city;";

Script::addInlineScript($content);