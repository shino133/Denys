<?php
include 'app/features/AppLoader.php';

// Supporter
// AppLoader::helper('core/master');
AppLoader::helper('master');
AppLoader::constant('master');

// Cache setup
// Cache::configure(__DIR__. '../cache', 3600);

// Library
// AppLoader::lib('encryptData');
// AppLoader::lib('apiRender');