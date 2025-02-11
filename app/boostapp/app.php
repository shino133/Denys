<?php

use App\Features\AppLoader;
use App\Features\AutoLogout;
use App\Utils\Helpers\Cache;

// set base path
AppLoader::setBasePath(__DIR__.'/../');

// load configs
AppLoader::include("Configs/env");

// run app
Cache::configure(APP_CACHE_PATH ?? __DIR__.'/cache/', 3600);
AutoLogout::run();