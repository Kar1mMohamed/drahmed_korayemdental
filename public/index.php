<?php

use Illuminate\Http\Request;


echo "TEST TEST TEST TEST 2";


define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Bypass Composer platform check by loading autoloader components directly
$vendorDir = __DIR__.'/../vendor';

// Skip the platform check and load autoloader directly
if (file_exists($vendorDir . '/autoload.php')) {
    // Define constant to skip platform check
    define('COMPOSER_PLATFORM_CHECK', 0);

    // Register the Composer autoloader...
    require $vendorDir . '/autoload.php';
} else {
    die('Composer autoloader not found. Run: composer install');
}

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
