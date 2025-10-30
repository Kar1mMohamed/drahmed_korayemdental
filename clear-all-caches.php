<?php
/**
 * Clear All Laravel Caches
 *
 * This script clears all Laravel caches to ensure fresh configuration is loaded.
 * Run this after updating .env file to clear cached database credentials.
 *
 * Usage: php clear-all-caches.php
 * Or visit in browser: https://yourdomain.com/clear-all-caches.php
 *
 * DELETE THIS FILE AFTER USE!
 */

echo "=== Clear All Laravel Caches ===\n\n";

$basePath = __DIR__;

// Function to run artisan command
function runArtisan($command, $description) {
    global $basePath;
    echo "{$description}...\n";

    $output = [];
    $returnVar = 0;

    exec("cd " . escapeshellarg($basePath) . " && php artisan {$command} 2>&1", $output, $returnVar);

    if ($returnVar === 0) {
        echo "✓ Success\n";
        if (!empty($output)) {
            foreach ($output as $line) {
                echo "  {$line}\n";
            }
        }
    } else {
        echo "⚠ Command completed with warnings\n";
        if (!empty($output)) {
            foreach ($output as $line) {
                echo "  {$line}\n";
            }
        }
    }
    echo "\n";

    return $returnVar === 0;
}

// Function to delete cache files manually
function deleteCacheFiles($path, $description) {
    echo "{$description}...\n";

    if (!is_dir($path)) {
        echo "⚠ Directory not found: {$path}\n\n";
        return false;
    }

    $files = glob($path . '/*.php');
    $count = 0;

    foreach ($files as $file) {
        if (basename($file) !== '.gitignore') {
            if (unlink($file)) {
                $count++;
            }
        }
    }

    echo "✓ Deleted {$count} cache files\n\n";
    return true;
}

echo "Step 1: Clearing configuration cache...\n";
runArtisan('config:clear', 'Running config:clear');

echo "Step 2: Clearing application cache...\n";
runArtisan('cache:clear', 'Running cache:clear');

echo "Step 3: Clearing route cache...\n";
runArtisan('route:clear', 'Running route:clear');

echo "Step 4: Clearing view cache...\n";
runArtisan('view:clear', 'Running view:clear');

echo "Step 5: Clearing compiled files...\n";
runArtisan('clear-compiled', 'Running clear-compiled');

echo "Step 6: Clearing bootstrap cache files...\n";
deleteCacheFiles($basePath . '/bootstrap/cache', 'Deleting bootstrap/cache/*.php');

echo "Step 7: Clearing framework cache files...\n";
deleteCacheFiles($basePath . '/storage/framework/cache/data', 'Deleting storage/framework/cache/data/*');

echo "Step 8: Clearing view compiled files...\n";
deleteCacheFiles($basePath . '/storage/framework/views', 'Deleting storage/framework/views/*.php');

echo "Step 9: Showing current database configuration...\n";
echo "Reading from .env file:\n";

$envFile = $basePath . '/.env';
if (file_exists($envFile)) {
    $envContent = file_get_contents($envFile);

    $dbKeys = ['DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'];

    foreach ($dbKeys as $key) {
        if (preg_match("/^{$key}=(.*)$/m", $envContent, $matches)) {
            $value = trim($matches[1], '"\'');
            if ($key === 'DB_PASSWORD') {
                $value = str_repeat('*', strlen($value));
            }
            echo "  {$key}={$value}\n";
        }
    }
} else {
    echo "  ⚠ .env file not found\n";
}
echo "\n";

echo "=== All Caches Cleared! ===\n\n";

echo "What was cleared:\n";
echo "  ✓ Configuration cache (cached .env values)\n";
echo "  ✓ Application cache\n";
echo "  ✓ Route cache\n";
echo "  ✓ View cache (compiled Blade templates)\n";
echo "  ✓ Compiled class files\n";
echo "  ✓ Bootstrap cache files\n";
echo "  ✓ Framework cache data\n\n";

echo "Next steps:\n";
echo "1. Run: php test-db-connection.php (to verify connection)\n";
echo "2. Run: php run-migrations-safe.php (to create tables)\n";
echo "3. Test your application\n";
echo "4. Delete this file: rm clear-all-caches.php\n";
