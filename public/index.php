<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Enable error logging for debugging
$debugMode = getenv('APP_DEBUG') === 'true' || (isset($_GET['debug']) && $_GET['debug'] === 'true');
$logDir = __DIR__.'/../storage/logs';
$logFile = $logDir . '/bootstrap-debug.log';

function logDebug($message, $logFile, $debugMode) {
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] {$message}\n";

    // Try to create log directory if it doesn't exist
    $logDir = dirname($logFile);
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0775, true);
    }

    // Try to log to file
    $logged = @file_put_contents($logFile, $logMessage, FILE_APPEND);

    // If file logging failed and debug mode is on, show why
    if (!$logged && $debugMode) {
        echo "<pre style='color: orange;'>[{$timestamp}] WARNING: Could not write to log file: {$logFile}</pre>";
    }

    // Display on screen if debug mode
    if ($debugMode) {
        echo "<pre>{$logMessage}</pre>";
    }
}

logDebug("=== Bootstrap Started ===", $logFile, $debugMode);
logDebug("Current directory: " . __DIR__, $logFile, $debugMode);
logDebug("Document root: " . $_SERVER['DOCUMENT_ROOT'], $logFile, $debugMode);
logDebug("Script filename: " . $_SERVER['SCRIPT_FILENAME'], $logFile, $debugMode);

// Check critical paths
$paths = [
    'Maintenance file' => __DIR__.'/../storage/framework/maintenance.php',
    'Autoloader' => __DIR__.'/../vendor/autoload.php',
    'Bootstrap' => __DIR__.'/../bootstrap/app.php',
    'Storage directory' => __DIR__.'/../storage',
    'Logs directory' => __DIR__.'/../storage/logs',
    'Framework directory' => __DIR__.'/../storage/framework',
    'Views directory' => __DIR__.'/../storage/framework/views',
    'Cache directory' => __DIR__.'/../storage/framework/cache',
    'Cache/data directory' => __DIR__.'/../storage/framework/cache/data',
    'Sessions directory' => __DIR__.'/../storage/framework/sessions',
];

foreach ($paths as $name => $path) {
    $exists = file_exists($path);
    $writable = $exists && is_writable($path);
    $status = $exists ? ($writable ? 'EXISTS & WRITABLE' : 'EXISTS BUT NOT WRITABLE') : 'MISSING';
    logDebug("{$name}: {$status} - {$path}", $logFile, $debugMode);
}

// Determine if the application is in maintenance mode...
try {
    logDebug("Checking maintenance mode...", $logFile, $debugMode);
    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        logDebug("Maintenance mode active, loading maintenance.php", $logFile, $debugMode);
        require $maintenance;
    } else {
        logDebug("No maintenance mode detected", $logFile, $debugMode);
    }
} catch (Exception $e) {
    logDebug("ERROR in maintenance check: " . $e->getMessage(), $logFile, $debugMode);
    throw $e;
}

// Register the Composer autoloader...
try {
    logDebug("Loading Composer autoloader...", $logFile, $debugMode);
    require __DIR__.'/../vendor/autoload.php';
    logDebug("Composer autoloader loaded successfully", $logFile, $debugMode);
} catch (Exception $e) {
    logDebug("ERROR loading autoloader: " . $e->getMessage(), $logFile, $debugMode);
    die("Failed to load Composer autoloader. Run 'composer install' first.");
}

// Bootstrap Laravel and handle the request...
try {
    logDebug("Bootstrapping Laravel application...", $logFile, $debugMode);
    /** @var Application $app */
    $app = require_once __DIR__.'/../bootstrap/app.php';
    logDebug("Laravel application bootstrapped successfully", $logFile, $debugMode);
} catch (Exception $e) {
    logDebug("ERROR bootstrapping Laravel: " . $e->getMessage(), $logFile, $debugMode);
    logDebug("Stack trace: " . $e->getTraceAsString(), $logFile, $debugMode);
    throw $e;
}

try {
    logDebug("Handling request...", $logFile, $debugMode);
    $app->handleRequest(Request::capture());
    logDebug("Request handled successfully", $logFile, $debugMode);
} catch (Exception $e) {
    logDebug("ERROR handling request: " . $e->getMessage(), $logFile, $debugMode);
    logDebug("Stack trace: " . $e->getTraceAsString(), $logFile, $debugMode);
    throw $e;
}
