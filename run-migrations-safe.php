<?php
/**
 * Run Migrations Safely
 *
 * This script runs Laravel migrations to create database tables,
 * including the sessions table required for database session storage.
 *
 * Usage: php run-migrations-safe.php
 * Or visit in browser: https://yourdomain.com/run-migrations-safe.php
 *
 * DELETE THIS FILE AFTER USE!
 */

echo "=== Run Laravel Migrations ===\n\n";

$basePath = __DIR__;

// Check if vendor exists
if (!file_exists($basePath . '/vendor/autoload.php')) {
    die("❌ ERROR: Composer dependencies not installed.\nRun: composer install\n");
}

// Check if .env exists
if (!file_exists($basePath . '/.env')) {
    die("❌ ERROR: .env file not found.\n");
}

echo "Step 1: Testing database connection...\n";

// Test connection first
$envContent = file_get_contents($basePath . '/.env');
$dbValues = [];

foreach (['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD', 'DB_PORT'] as $key) {
    if (preg_match("/^{$key}=(.*)$/m", $envContent, $matches)) {
        $dbValues[$key] = trim($matches[1], '"\'');
    }
}

try {
    $dsn = "mysql:host={$dbValues['DB_HOST']};dbname={$dbValues['DB_DATABASE']};port=" . ($dbValues['DB_PORT'] ?? '3306');
    $pdo = new PDO(
        $dsn,
        $dbValues['DB_USERNAME'],
        $dbValues['DB_PASSWORD'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "✓ Database connection successful\n\n";
} catch (PDOException $e) {
    die("❌ Database connection failed: " . $e->getMessage() . "\n\nFix connection first, then run migrations.\n");
}

echo "Step 2: Checking current database state...\n";

// Check existing tables
$stmt = $pdo->query("SHOW TABLES");
$existingTables = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo "Current tables (" . count($existingTables) . "):\n";
if (empty($existingTables)) {
    echo "  (No tables yet)\n";
} else {
    foreach ($existingTables as $table) {
        echo "  - {$table}\n";
    }
}
echo "\n";

// Check if migrations table exists
$hasMigrationsTable = in_array('migrations', $existingTables);
if ($hasMigrationsTable) {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM migrations");
    $migrationsCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "✓ Migrations table exists ({$migrationsCount} migrations run)\n";
} else {
    echo "⚠ Migrations table does not exist (first time setup)\n";
}
echo "\n";

echo "Step 3: Running migrations...\n";

// Run migrations
$output = [];
$returnVar = 0;

$command = "cd " . escapeshellarg($basePath) . " && php artisan migrate --force 2>&1";
exec($command, $output, $returnVar);

echo "Migration output:\n";
echo str_repeat('-', 60) . "\n";
foreach ($output as $line) {
    echo $line . "\n";
}
echo str_repeat('-', 60) . "\n\n";

if ($returnVar === 0) {
    echo "✓ Migrations completed successfully\n\n";
} else {
    echo "⚠ Migrations completed with warnings or errors\n\n";
}

echo "Step 4: Verifying database tables...\n";

// Check tables again
$stmt = $pdo->query("SHOW TABLES");
$newTables = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo "Database now has " . count($newTables) . " tables:\n";
foreach ($newTables as $table) {
    $isNew = !in_array($table, $existingTables);
    $marker = $isNew ? '✓ NEW' : '    ';
    echo "  {$marker} {$table}\n";
}
echo "\n";

// Specifically check for sessions table
$hasSessionsTable = in_array('sessions', $newTables);

if ($hasSessionsTable) {
    echo "✓ Sessions table exists\n";

    // Show sessions table structure
    $stmt = $pdo->query("DESCRIBE sessions");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "\nSessions table structure:\n";
    foreach ($columns as $column) {
        echo "  - {$column['Field']} ({$column['Type']})\n";
    }
    echo "\n";
} else {
    echo "⚠ Sessions table was NOT created\n";
    echo "  Check migration files in database/migrations/\n\n";
}

echo "Step 5: Creating sessions migration if missing...\n";

if (!$hasSessionsTable) {
    echo "Attempting to create sessions table migration...\n";

    $output = [];
    $command = "cd " . escapeshellarg($basePath) . " && php artisan session:table 2>&1";
    exec($command, $output, $returnVar);

    foreach ($output as $line) {
        echo "  {$line}\n";
    }

    if ($returnVar === 0) {
        echo "\nNow running migrations again...\n";

        $output = [];
        $command = "cd " . escapeshellarg($basePath) . " && php artisan migrate --force 2>&1";
        exec($command, $output, $returnVar);

        foreach ($output as $line) {
            echo "  {$line}\n";
        }
    }
    echo "\n";
}

echo "=== Migration Process Complete ===\n\n";

// Final check
$stmt = $pdo->query("SHOW TABLES");
$finalTables = $stmt->fetchAll(PDO::FETCH_COLUMN);
$hasSessionsNow = in_array('sessions', $finalTables);

echo "Summary:\n";
echo "  Total tables: " . count($finalTables) . "\n";
echo "  Sessions table: " . ($hasSessionsNow ? "✓ EXISTS" : "❌ MISSING") . "\n";
echo "  Migrations table: " . (in_array('migrations', $finalTables) ? "✓ EXISTS" : "❌ MISSING") . "\n\n";

if ($hasSessionsNow) {
    echo "✓ SUCCESS! Your database is ready.\n\n";
    echo "Next steps:\n";
    echo "1. Test your application\n";
    echo "2. Delete diagnostic files:\n";
    echo "   rm update-env-credentials.php\n";
    echo "   rm clear-all-caches.php\n";
    echo "   rm test-db-connection.php\n";
    echo "   rm run-migrations-safe.php\n";
} else {
    echo "⚠ Sessions table is still missing.\n\n";
    echo "Manual solution:\n";
    echo "1. Run: php artisan session:table\n";
    echo "2. Run: php artisan migrate --force\n";
    echo "3. Or check database/migrations/ for session migration file\n";
}
