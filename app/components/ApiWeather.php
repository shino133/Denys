<?php

use App\Utils\Helpers\Action;
use App\Utils\Helpers\Cache;

$weatherData = Cache::get('weatherDataApi', 'weather/');

[$temperature, $city] = isset($weatherData) && ! empty($weatherData)
  ? [$weatherData['temperature'], $weatherData['city']]
  : Action::runAuto(function () {
    $apiKey = API_WEATHER_KEY;
    $city = API_WEATHER_CITY; // Tên thành phố bạn muốn lấy dữ liệu
  
    // Tạo URL yêu cầu
    $url = 'http://api.weatherapi.com/v1/current.json?key=' . $apiKey . '&q=' . $city;

    // Gửi yêu cầu và lấy dữ liệu
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    $temperature = $data['current']['temp_c'];
    $city = $data['location']['name'];

    Cache::set(key: 'weatherDataApi', data: ['temperature' => $temperature, 'city' => $city], expiration: 3600, cacheFolder: 'weather/');

    return [$temperature, $city];
  });
?>

<div class="weather-small text-white">
  <p class="current-weather">
    <i class="bx bx-sun"></i> <span><?= $temperature ?></span>&deg;
  </p>
  <p class="weather-city"><?= $city ?></p>
</div>