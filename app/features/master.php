<?php
include 'app/utils/helpers/Loader.php';

// App Loader
Loader::include('features/AppLoader');

// Supporter
AppLoader::helper('Authentication');
AppLoader::helper('Action');
AppLoader::helper('Link');
AppLoader::helper('Meta');
AppLoader::helper('Route');
AppLoader::helper('Store');
AppLoader::helper('Script');
AppLoader::helper('Cache');
AppLoader::helper('Title');
AppLoader::helper('Url');

AppLoader::feature('Auth');

// Constants
AppLoader::constant('master');

// Library
AppLoader::lib('dumpVar');

// Cache setup
Cache::configure(__DIR__. '/cache/', 3600);

// Library
// AppLoader::lib('encryptData');
// AppLoader::lib('apiRender');