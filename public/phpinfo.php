<?php
// Diagnostic script to check server configuration
// DELETE THIS FILE after debugging

header('Content-Type: text/plain');

echo "=== SERVER DIAGNOSTICS ===\n\n";

echo "PHP Version: " . PHP_VERSION . "\n";
echo "PHP Version ID: " . PHP_VERSION_ID . "\n";
echo "Required Version ID: 80200\n";
echo "Version Check: " . (PHP_VERSION_ID >= 80200 ? 'PASS' : 'FAIL') . "\n\n";

echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n\n";

echo "Current Directory: " . __DIR__ . "\n";
echo "Parent Directory: " . dirname(__DIR__) . "\n\n";

// Check for critical Laravel files
$laravelRoot = dirname(__DIR__);
$checks = [
    'vendor/autoload.php' => $laravelRoot . '/vendor/autoload.php',
    'bootstrap/app.php' => $laravelRoot . '/bootstrap/app.php',
    'storage/framework/maintenance.php' => $laravelRoot . '/storage/framework/maintenance.php',
    '.env' => $laravelRoot . '/.env',
    'composer.json' => $laravelRoot . '/composer.json',
];

echo "=== FILE EXISTENCE CHECKS ===\n\n";
foreach ($checks as $name => $path) {
    $exists = file_exists($path);
    $readable = $exists ? is_readable($path) : false;
    echo sprintf(
        "%-35s: %s %s\n",
        $name,
        $exists ? 'EXISTS' : 'MISSING',
        $readable ? '(readable)' : ($exists ? '(not readable)' : '')
    );
}

echo "\n=== LOADED EXTENSIONS ===\n\n";
$extensions = get_loaded_extensions();
sort($extensions);
echo implode(', ', $extensions) . "\n";

echo "\n=== COMPOSER PLATFORM CHECK ===\n";
$platformCheckPath = $laravelRoot . '/vendor/composer/platform_check.php';
if (file_exists($platformCheckPath)) {
    echo "Platform check file: EXISTS\n";
    echo "Content preview:\n";
    echo substr(file_get_contents($platformCheckPath), 0, 500) . "...\n";
} else {
    echo "Platform check file: MISSING\n";
}
