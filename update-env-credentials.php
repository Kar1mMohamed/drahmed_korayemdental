<?php
/**
 * Update .env File with Correct Database Credentials
 *
 * This script updates your .env file with the correct database credentials
 * and creates a backup of the old file.
 *
 * Usage: php update-env-credentials.php
 * Or visit in browser: https://yourdomain.com/update-env-credentials.php
 *
 * DELETE THIS FILE AFTER USE!
 */

echo "=== Update Database Credentials in .env ===\n\n";

$basePath = __DIR__;
$envFile = $basePath . '/.env';
$backupFile = $basePath . '/.env.backup.' . date('Y-m-d_His');

// Correct database credentials
$correctCredentials = [
    'DB_CONNECTION' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_PORT' => '3306',
    'DB_DATABASE' => 'u917077655_drahmed',
    'DB_USERNAME' => 'u917077655_drahmed',
    'DB_PASSWORD' => '4SnmPXUn=',
];

echo "Step 1: Checking .env file...\n";
if (!file_exists($envFile)) {
    die("❌ ERROR: .env file not found at: {$envFile}\n");
}
echo "✓ .env file found\n\n";

echo "Step 2: Creating backup...\n";
if (copy($envFile, $backupFile)) {
    echo "✓ Backup created: {$backupFile}\n\n";
} else {
    die("❌ ERROR: Could not create backup file\n");
}

echo "Step 3: Reading current .env file...\n";
$envContent = file_get_contents($envFile);
$currentValues = [];

// Parse current values
foreach ($correctCredentials as $key => $value) {
    if (preg_match("/^{$key}=(.*)$/m", $envContent, $matches)) {
        $currentValues[$key] = trim($matches[1], '"\'');
    }
}

echo "Current database configuration:\n";
foreach ($correctCredentials as $key => $value) {
    $current = $currentValues[$key] ?? 'NOT SET';
    if ($key === 'DB_PASSWORD') {
        $current = $current ? '***' : 'NOT SET';
        $value = '***';
    }
    $match = isset($currentValues[$key]) && $currentValues[$key] === $correctCredentials[$key];
    $status = $match ? '✓' : '✗';
    echo "  {$status} {$key}: {$current}" . ($match ? '' : " → {$value}") . "\n";
}
echo "\n";

echo "Step 4: Updating .env file with correct credentials...\n";
$newEnvContent = $envContent;

foreach ($correctCredentials as $key => $value) {
    // Escape special characters in value for regex
    $escapedValue = preg_quote($value, '/');

    // Check if key exists
    if (preg_match("/^{$key}=/m", $newEnvContent)) {
        // Update existing key
        $newEnvContent = preg_replace(
            "/^{$key}=.*$/m",
            "{$key}={$value}",
            $newEnvContent
        );
        echo "  ✓ Updated {$key}\n";
    } else {
        // Add new key after DB_CONNECTION or at end
        if ($key === 'DB_CONNECTION') {
            $newEnvContent .= "\n{$key}={$value}\n";
        } else {
            // Add after the previous DB_ key
            $newEnvContent = preg_replace(
                "/(DB_[A-Z_]+=.*\n)/",
                "$1{$key}={$value}\n",
                $newEnvContent,
                1
            );
        }
        echo "  ✓ Added {$key}\n";
    }
}
echo "\n";

echo "Step 5: Writing updated .env file...\n";
if (file_put_contents($envFile, $newEnvContent)) {
    echo "✓ .env file updated successfully\n\n";
} else {
    die("❌ ERROR: Could not write to .env file\n");
}

echo "Step 6: Testing database connection...\n";
try {
    $dsn = "mysql:host={$correctCredentials['DB_HOST']};dbname={$correctCredentials['DB_DATABASE']};port={$correctCredentials['DB_PORT']}";
    $pdo = new PDO(
        $dsn,
        $correctCredentials['DB_USERNAME'],
        $correctCredentials['DB_PASSWORD'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    echo "✓ Database connection successful!\n";
    echo "  Connected to: {$correctCredentials['DB_DATABASE']}\n";
    echo "  Server version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n\n";

    // Test query
    $stmt = $pdo->query("SELECT DATABASE() as db, USER() as user");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "  Current database: {$result['db']}\n";
    echo "  Current user: {$result['user']}\n\n";

} catch (PDOException $e) {
    echo "❌ Database connection FAILED: " . $e->getMessage() . "\n";
    echo "\nRestoring backup...\n";
    copy($backupFile, $envFile);
    echo "✓ Backup restored\n";
    die("\nPlease check your database credentials and try again.\n");
}

echo "=== SUCCESS! ===\n\n";
echo "Next steps:\n";
echo "1. Run: php clear-all-caches.php\n";
echo "2. Run: php test-db-connection.php\n";
echo "3. Run: php run-migrations-safe.php\n";
echo "4. Delete this file: rm update-env-credentials.php\n\n";

echo "Backup saved at: {$backupFile}\n";
echo "(You can delete the backup file once everything is working)\n";
