<?php
/**
 * Server Diagnostic Script
 * Upload this to your server and run it to diagnose issues
 *
 * Usage:
 * - Via browser: https://yourdomain.com/diagnose-server.php
 * - Via CLI: php diagnose-server.php
 *
 * DELETE THIS FILE AFTER USE FOR SECURITY!
 */

header('Content-Type: text/html; charset=utf-8');

echo "<!DOCTYPE html><html><head><title>Laravel Server Diagnostics</title>";
echo "<style>
body { font-family: monospace; padding: 20px; background: #f5f5f5; }
.section { background: white; padding: 15px; margin: 10px 0; border-radius: 5px; }
.success { color: green; font-weight: bold; }
.error { color: red; font-weight: bold; }
.warning { color: orange; font-weight: bold; }
.info { color: blue; }
h2 { border-bottom: 2px solid #333; padding-bottom: 5px; }
pre { background: #f0f0f0; padding: 10px; overflow-x: auto; }
</style></head><body>";

echo "<h1>🔍 Laravel Server Diagnostics</h1>";

// 1. PHP Version Check
echo "<div class='section'>";
echo "<h2>1. PHP Version</h2>";
echo "PHP Version: <span class='info'>" . phpversion() . "</span><br>";
$phpVersion = phpversion();
if (version_compare($phpVersion, '8.2.0', '>=')) {
    echo "<span class='success'>✓ PHP version is compatible (8.2+)</span>";
} else {
    echo "<span class='error'>✗ PHP version is too old. Need 8.2+</span>";
}
echo "</div>";

// 2. Required PHP Extensions
echo "<div class='section'>";
echo "<h2>2. PHP Extensions</h2>";
$requiredExtensions = ['pdo', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json', 'bcmath'];
foreach ($requiredExtensions as $ext) {
    $loaded = extension_loaded($ext);
    $status = $loaded ? "<span class='success'>✓ Loaded</span>" : "<span class='error'>✗ Missing</span>";
    echo "{$ext}: {$status}<br>";
}
echo "</div>";

// 3. Directory Structure
echo "<div class='section'>";
echo "<h2>3. Directory Structure</h2>";
$basePath = __DIR__;
$directories = [
    'storage' => $basePath . '/storage',
    'storage/app' => $basePath . '/storage/app',
    'storage/app/public' => $basePath . '/storage/app/public',
    'storage/framework' => $basePath . '/storage/framework',
    'storage/framework/cache' => $basePath . '/storage/framework/cache',
    'storage/framework/cache/data' => $basePath . '/storage/framework/cache/data',
    'storage/framework/sessions' => $basePath . '/storage/framework/sessions',
    'storage/framework/views' => $basePath . '/storage/framework/views',
    'storage/logs' => $basePath . '/storage/logs',
    'bootstrap/cache' => $basePath . '/bootstrap/cache',
];

foreach ($directories as $name => $path) {
    $exists = is_dir($path);
    $writable = $exists && is_writable($path);

    if (!$exists) {
        echo "{$name}: <span class='error'>✗ MISSING</span> - {$path}<br>";
    } elseif (!$writable) {
        echo "{$name}: <span class='warning'>⚠ EXISTS but NOT WRITABLE</span> - {$path}<br>";
    } else {
        echo "{$name}: <span class='success'>✓ OK</span><br>";
    }
}
echo "</div>";

// 4. Critical Files
echo "<div class='section'>";
echo "<h2>4. Critical Files</h2>";
$files = [
    '.env' => $basePath . '/.env',
    'composer.json' => $basePath . '/composer.json',
    'vendor/autoload.php' => $basePath . '/vendor/autoload.php',
    'bootstrap/app.php' => $basePath . '/bootstrap/app.php',
    'artisan' => $basePath . '/artisan',
];

foreach ($files as $name => $path) {
    $exists = file_exists($path);
    $readable = $exists && is_readable($path);

    if (!$exists) {
        echo "{$name}: <span class='error'>✗ MISSING</span> - {$path}<br>";
    } elseif (!$readable) {
        echo "{$name}: <span class='warning'>⚠ EXISTS but NOT READABLE</span><br>";
    } else {
        echo "{$name}: <span class='success'>✓ OK</span><br>";
    }
}
echo "</div>";

// 5. File Permissions
echo "<div class='section'>";
echo "<h2>5. File Permissions</h2>";
foreach ($directories as $name => $path) {
    if (is_dir($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        $color = (intval($perms) >= 755) ? 'success' : 'warning';
        echo "{$name}: <span class='{$color}'>{$perms}</span><br>";
    }
}
echo "</div>";

// 6. Environment Variables
echo "<div class='section'>";
echo "<h2>6. Environment Check</h2>";
$envFile = $basePath . '/.env';
if (file_exists($envFile)) {
    echo ".env file: <span class='success'>✓ EXISTS</span><br>";
    $envContent = file_get_contents($envFile);

    // Check critical env vars (without showing values)
    $criticalVars = ['APP_KEY', 'APP_ENV', 'APP_DEBUG', 'DB_CONNECTION', 'DB_HOST', 'DB_DATABASE'];
    foreach ($criticalVars as $var) {
        $exists = strpos($envContent, $var . '=') !== false;
        $status = $exists ? "<span class='success'>✓ SET</span>" : "<span class='error'>✗ MISSING</span>";
        echo "{$var}: {$status}<br>";
    }
} else {
    echo ".env file: <span class='error'>✗ MISSING</span><br>";
    echo "<span class='warning'>Copy .env.example to .env and configure it!</span><br>";
}
echo "</div>";

// 7. Composer Status
echo "<div class='section'>";
echo "<h2>7. Composer Dependencies</h2>";
if (file_exists($basePath . '/vendor/autoload.php')) {
    echo "Vendor directory: <span class='success'>✓ EXISTS</span><br>";

    if (file_exists($basePath . '/composer.lock')) {
        $lockData = json_decode(file_get_contents($basePath . '/composer.lock'), true);
        $packageCount = count($lockData['packages'] ?? []) + count($lockData['packages-dev'] ?? []);
        echo "Installed packages: <span class='info'>{$packageCount}</span><br>";

        // Check for Laravel
        foreach (($lockData['packages'] ?? []) as $package) {
            if ($package['name'] === 'laravel/framework') {
                echo "Laravel version: <span class='info'>{$package['version']}</span><br>";
                break;
            }
        }
    }
} else {
    echo "Vendor directory: <span class='error'>✗ MISSING</span><br>";
    echo "<span class='warning'>Run: composer install</span><br>";
}
echo "</div>";

// 8. Laravel Artisan Test
echo "<div class='section'>";
echo "<h2>8. Laravel Artisan Test</h2>";
if (file_exists($basePath . '/artisan')) {
    try {
        $output = shell_exec('cd ' . escapeshellarg($basePath) . ' && php artisan --version 2>&1');
        if ($output) {
            echo "<span class='success'>✓ Artisan working</span><br>";
            echo "<pre>{$output}</pre>";
        } else {
            echo "<span class='warning'>⚠ Could not execute artisan</span><br>";
        }
    } catch (Exception $e) {
        echo "<span class='error'>✗ Artisan error: " . $e->getMessage() . "</span><br>";
    }
}
echo "</div>";

// 9. Recent Laravel Logs
echo "<div class='section'>";
echo "<h2>9. Recent Laravel Logs</h2>";
$logFile = $basePath . '/storage/logs/laravel.log';
if (file_exists($logFile)) {
    echo "<span class='info'>Last modified: " . date('Y-m-d H:i:s', filemtime($logFile)) . "</span><br>";
    $logContent = file_get_contents($logFile);
    $lines = explode("\n", $logContent);
    $recentLines = array_slice($lines, -50); // Last 50 lines
    echo "<pre>" . htmlspecialchars(implode("\n", $recentLines)) . "</pre>";
} else {
    echo "<span class='info'>No log file yet</span><br>";
}
echo "</div>";

// 10. Server Information
echo "<div class='section'>";
echo "<h2>10. Server Information</h2>";
echo "Server Software: <span class='info'>" . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "</span><br>";
echo "Document Root: <span class='info'>" . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "</span><br>";
echo "Script Path: <span class='info'>" . __FILE__ . "</span><br>";
echo "Current User: <span class='info'>" . (function_exists('posix_getpwuid') ? posix_getpwuid(posix_geteuid())['name'] : 'Unknown') . "</span><br>";
echo "Memory Limit: <span class='info'>" . ini_get('memory_limit') . "</span><br>";
echo "Max Execution Time: <span class='info'>" . ini_get('max_execution_time') . "s</span><br>";
echo "Timezone: <span class='info'>" . date_default_timezone_get() . "</span><br>";
echo "</div>";

// 11. Quick Fix Suggestions
echo "<div class='section'>";
echo "<h2>11. Quick Fix Commands</h2>";
echo "<p>If you see missing or non-writable directories, run these commands:</p>";
echo "<pre>";
echo "# Create directories\n";
echo "mkdir -p storage/framework/cache/data\n";
echo "mkdir -p storage/framework/sessions\n";
echo "mkdir -p storage/framework/views\n";
echo "mkdir -p storage/logs\n\n";

echo "# Set permissions\n";
echo "chmod -R 775 storage bootstrap/cache\n\n";

echo "# Clear caches\n";
echo "php artisan config:clear\n";
echo "php artisan cache:clear\n";
echo "php artisan view:clear\n\n";

echo "# Install dependencies\n";
echo "composer install --no-dev --optimize-autoloader\n";
echo "</pre>";
echo "</div>";

echo "<div class='section' style='background: #fff3cd; border: 2px solid #ffc107;'>";
echo "<h2>⚠️ SECURITY WARNING</h2>";
echo "<p style='color: red; font-weight: bold;'>DELETE THIS FILE (diagnose-server.php) AFTER USE!</p>";
echo "<p>This file exposes sensitive information about your server configuration.</p>";
echo "</div>";

echo "</body></html>";
