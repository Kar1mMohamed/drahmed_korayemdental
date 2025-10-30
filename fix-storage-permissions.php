<?php
/**
 * Fix Storage Permissions Script
 * Run this on your Hostinger server to create missing directories and set permissions
 *
 * Usage: php fix-storage-permissions.php
 */

echo "=== Laravel Storage Directory Setup ===\n\n";

// Define base path (adjust if needed)
$basePath = __DIR__;

// Required directories
$directories = [
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/app/private',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/testing',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache',
];

// Create directories
echo "Creating directories...\n";
foreach ($directories as $dir) {
    $fullPath = $basePath . '/' . $dir;

    if (!is_dir($fullPath)) {
        if (mkdir($fullPath, 0775, true)) {
            echo "✓ Created: $dir\n";
        } else {
            echo "✗ Failed to create: $dir\n";
        }
    } else {
        echo "✓ Exists: $dir\n";
    }

    // Set permissions
    if (is_dir($fullPath)) {
        chmod($fullPath, 0775);
    }
}

// Create .gitignore files
echo "\nCreating .gitignore files...\n";

$gitignores = [
    'storage/app/.gitignore' => "*\n!private/\n!public/\n!.gitignore\n",
    'storage/app/public/.gitignore' => "*\n!.gitignore\n",
    'storage/app/private/.gitignore' => "*\n!.gitignore\n",
    'storage/framework/.gitignore' => "compiled.php\nconfig.php\ndown\nevents.scanned.php\nmaintenance.php\nroutes.php\nroutes.scanned.php\nschedule-*\nservices.json\n",
    'storage/framework/cache/.gitignore' => "*\n!data/\n!.gitignore\n",
    'storage/framework/cache/data/.gitignore' => "*\n!.gitignore\n",
    'storage/framework/sessions/.gitignore' => "*\n!.gitignore\n",
    'storage/framework/testing/.gitignore' => "*\n!.gitignore\n",
    'storage/framework/views/.gitignore' => "*\n!.gitignore\n",
    'storage/logs/.gitignore' => "*\n!.gitignore\n",
    'bootstrap/cache/.gitignore' => "*\n!.gitignore\n",
];

foreach ($gitignores as $file => $content) {
    $fullPath = $basePath . '/' . $file;
    if (!file_exists($fullPath)) {
        if (file_put_contents($fullPath, $content)) {
            echo "✓ Created: $file\n";
        } else {
            echo "✗ Failed to create: $file\n";
        }
    } else {
        echo "✓ Exists: $file\n";
    }
}

// Clear any cached files that might be corrupt
echo "\nClearing cached files...\n";
$cacheFiles = [
    'bootstrap/cache/packages.php',
    'bootstrap/cache/services.php',
    'bootstrap/cache/config.php',
    'bootstrap/cache/routes-v7.php',
    'bootstrap/cache/events.php',
];

foreach ($cacheFiles as $file) {
    $fullPath = $basePath . '/' . $file;
    if (file_exists($fullPath)) {
        if (unlink($fullPath)) {
            echo "✓ Deleted: $file\n";
        }
    }
}

// Check writable permissions
echo "\nChecking write permissions...\n";
$checkDirs = [
    'storage',
    'storage/framework/cache',
    'storage/framework/views',
    'storage/logs',
    'bootstrap/cache',
];

foreach ($checkDirs as $dir) {
    $fullPath = $basePath . '/' . $dir;
    if (is_writable($fullPath)) {
        echo "✓ Writable: $dir\n";
    } else {
        echo "✗ NOT writable: $dir (chmod 775 needed)\n";
    }
}

echo "\n=== Done! ===\n";
echo "Now run: php artisan config:clear\n";
echo "Then run: composer install --no-dev --optimize-autoloader\n";
