<?php

use App\Features\AppLoader;
use App\Features\AutoLogout;
use App\Utils\Helpers\Cache;

AppLoader::setBasePath(__DIR__.'/../');
AppLoader::include("configs/env");
Cache::configure(APP_CACHE_PATH ?? __DIR__.'/cache/', 3600);
AutoLogout::run();