<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Detect the Laravel root directory
// This file can be in either the Laravel root or the public folder
$laravelRoot = __DIR__;

// If this file is in the root, paths are direct
// If running from public/, need to go up one level
if (!file_exists($laravelRoot . '/vendor/autoload.php')) {
    $laravelRoot = dirname(__DIR__);
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $laravelRoot . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $laravelRoot . '/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once $laravelRoot . '/bootstrap/app.php')
    ->handleRequest(Request::capture());
