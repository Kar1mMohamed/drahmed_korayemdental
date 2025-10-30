<?php
// Hostinger Diagnostic Script for korayemdental.com/drahmed
// Upload this file to your public_html directory and visit: https://korayemdental.com/drahmed/diagnose-final.php

echo "<h1>🔍 Dr. Ahmed Korayem Website - Hostinger Diagnostic</h1>";
echo "<p><strong>Expected URL:</strong> <a href='https://drahmed.korayemdental.com' target='_blank'>https://drahmed.korayemdental.com</a></p>";
echo "<p><strong>Server Path:</strong> /home/u917077655/domains/korayemdental.com/public_html/drahmed</p>";
echo "<hr>";

// 1. Check PHP Version
echo "<h2>📋 PHP Configuration</h2>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Required:</strong> PHP 8.2+</p>";

if (version_compare(phpversion(), '8.2.0', '>=')) {
    echo "<p style='color: green;'>✅ PHP version is compatible</p>";
} else {
    echo "<p style='color: red;'>❌ PHP version needs to be updated to 8.2+</p>";
}

// 2. Detect Laravel Path
echo "<h2>📁 Laravel Path Detection</h2>";
$possiblePaths = [
    '/home/u917077655/domains/korayemdental.com/public_html/drahmed',
    '/home/u917077655/domains/korayemdental.com/public_html',
    dirname(__FILE__),
    realpath('.'),
];

$laravelPath = null;
foreach ($possiblePaths as $path) {
    if (file_exists($path . '/artisan') && file_exists($path . '/bootstrap/app.php')) {
        $laravelPath = $path;
        echo "<p style='color: green;'>✅ Laravel found at: <strong>$path</strong></p>";
        break;
    } else {
        echo "<p style='color: orange;'>⚠️ Checking: $path - Not found</p>";
    }
}

if (!$laravelPath) {
    echo "<p style='color: red;'>❌ Laravel installation not found in any expected location</p>";
    exit;
}

// 3. Check File Permissions
echo "<h2>🔐 File Permissions Check</h2>";
$checkPaths = [
    $laravelPath . '/storage',
    $laravelPath . '/bootstrap/cache',
    $laravelPath . '/.env'
];

foreach ($checkPaths as $path) {
    if (file_exists($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        $writable = is_writable($path) ? '✅ Writable' : '❌ Not Writable';
        echo "<p><strong>$path:</strong> $perms - $writable</p>";
    } else {
        echo "<p style='color: red;'><strong>$path:</strong> ❌ Does not exist</p>";
    }
}

// 4. Test Database Connection
echo "<h2>🗄️ Database Connection Test</h2>";
$envFile = $laravelPath . '/.env';
if (file_exists($envFile)) {
    $envContent = file_get_contents($envFile);
    
    // Parse .env file
    preg_match('/DB_HOST=(.*)/', $envContent, $hostMatch);
    preg_match('/DB_DATABASE=(.*)/', $envContent, $dbMatch);
    preg_match('/DB_USERNAME=(.*)/', $envContent, $userMatch);
    preg_match('/DB_PASSWORD=(.*)/', $envContent, $passMatch);
    
    $host = isset($hostMatch[1]) ? trim($hostMatch[1]) : '127.0.0.1';
    $database = isset($dbMatch[1]) ? trim($dbMatch[1]) : '';
    $username = isset($userMatch[1]) ? trim($userMatch[1]) : '';
    $password = isset($passMatch[1]) ? trim($passMatch[1]) : '';
    
    echo "<p><strong>Host:</strong> $host</p>";
    echo "<p><strong>Database:</strong> $database</p>";
    echo "<p><strong>Username:</strong> $username</p>";
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        echo "<p style='color: green;'>✅ Database connection successful</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>❌ Database connection failed: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ .env file not found</p>";
}

// 5. Generate Corrected index.php
echo "<h2>📝 Corrected index.php Content</h2>";
echo "<p>Copy this content to your <strong>public_html/index.php</strong> file:</p>";
echo "<textarea rows='30' cols='80' style='width: 100%; font-family: monospace;'>";
echo htmlspecialchars('<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define(\'LARAVEL_START\', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
*/

$maintenance = \'' . $laravelPath . '/storage/framework/maintenance.php\';

if (file_exists($maintenance)) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/

require \'' . $laravelPath . '/vendor/autoload.php\';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

$app = require_once \'' . $laravelPath . '/bootstrap/app.php\';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);');
echo "</textarea>";

echo "<h2>🚀 Next Steps</h2>";
echo "<ol>";
echo "<li>Update PHP version to 8.2+ in Hostinger hPanel</li>";
echo "<li>Copy the corrected index.php content above to public_html/index.php</li>";
echo "<li>Set storage and bootstrap/cache permissions to 755</li>";
echo "<li>Test your website at: <a href='https://drahmed.korayemdental.com' target='_blank'>https://drahmed.korayemdental.com</a></li>";
echo "<li><strong>Delete this diagnostic file after use for security</strong></li>";
echo "</ol>";

echo "<p style='color: blue; margin-top: 20px;'><strong>🔒 Security Note:</strong> Delete this file after diagnosis!</p>";
?>