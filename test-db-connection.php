<?php
/**
 * Test Database Connection
 *
 * This script tests the database connection and shows what configuration
 * Laravel is actually using vs what's in the .env file.
 *
 * Usage: php test-db-connection.php
 * Or visit in browser: https://yourdomain.com/test-db-connection.php
 *
 * DELETE THIS FILE AFTER USE!
 */

echo "=== Database Connection Diagnostic ===\n\n";

$basePath = __DIR__;
$envFile = $basePath . '/.env';

// Step 1: Check .env file
echo "Step 1: Reading .env file...\n";
if (!file_exists($envFile)) {
    die("❌ ERROR: .env file not found at: {$envFile}\n");
}

$envContent = file_get_contents($envFile);
$envValues = [];

$dbKeys = ['DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'];

foreach ($dbKeys as $key) {
    if (preg_match("/^{$key}=(.*)$/m", $envContent, $matches)) {
        $envValues[$key] = trim($matches[1], '"\'');
    }
}

echo ".env file contains:\n";
foreach ($dbKeys as $key) {
    $value = $envValues[$key] ?? 'NOT SET';
    if ($key === 'DB_PASSWORD' && $value !== 'NOT SET') {
        $value = str_repeat('*', strlen($value));
    }
    echo "  {$key}={$value}\n";
}
echo "\n";

// Step 2: Test direct PDO connection
echo "Step 2: Testing direct PDO connection...\n";

$requiredKeys = ['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'];
$missing = [];

foreach ($requiredKeys as $key) {
    if (empty($envValues[$key])) {
        $missing[] = $key;
    }
}

if (!empty($missing)) {
    die("❌ ERROR: Missing required environment variables: " . implode(', ', $missing) . "\n");
}

$dsn = "mysql:host={$envValues['DB_HOST']};dbname={$envValues['DB_DATABASE']};port=" . ($envValues['DB_PORT'] ?? '3306');

try {
    $pdo = new PDO(
        $dsn,
        $envValues['DB_USERNAME'],
        $envValues['DB_PASSWORD'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    echo "✓ Direct PDO connection successful!\n\n";

    // Get server info
    echo "Server Information:\n";
    echo "  MySQL Version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n";
    echo "  Connection Status: " . $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n\n";

    // Test current database and user
    $stmt = $pdo->query("SELECT DATABASE() as db, USER() as user, VERSION() as version");
    $result = $stmt->fetch();

    echo "Connection Details:\n";
    echo "  Connected to database: {$result['db']}\n";
    echo "  Connected as user: {$result['user']}\n";
    echo "  Server version: {$result['version']}\n\n";

    // Check if sessions table exists
    echo "Checking for 'sessions' table...\n";
    $stmt = $pdo->query("SHOW TABLES LIKE 'sessions'");
    $sessionsExists = $stmt->rowCount() > 0;

    if ($sessionsExists) {
        echo "✓ 'sessions' table exists\n";

        // Count records
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM sessions");
        $count = $stmt->fetch()['count'];
        echo "  Total sessions: {$count}\n";
    } else {
        echo "⚠ 'sessions' table does NOT exist\n";
        echo "  You need to run migrations to create it\n";
    }
    echo "\n";

    // List all tables
    echo "All tables in database:\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (empty($tables)) {
        echo "  ⚠ No tables found - database is empty\n";
        echo "  You need to run migrations: php artisan migrate\n";
    } else {
        foreach ($tables as $table) {
            echo "  - {$table}\n";
        }
    }
    echo "\n";

} catch (PDOException $e) {
    echo "❌ Direct PDO connection FAILED!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "Error Code: " . $e->getCode() . "\n\n";

    echo "Common solutions:\n";
    echo "1. If error 1045 (Access denied):\n";
    echo "   - Verify username/password in Hostinger control panel\n";
    echo "   - Try DB_HOST=localhost instead of 127.0.0.1\n\n";

    echo "2. If error 1049 (Unknown database):\n";
    echo "   - Create database in Hostinger control panel\n";
    echo "   - Verify database name matches exactly\n\n";

    echo "3. If error 2002 (Connection refused/timeout):\n";
    echo "   - Check if MySQL service is running\n";
    echo "   - Verify DB_HOST (try localhost or 127.0.0.1)\n\n";

    die("Fix the error above and try again.\n");
}

// Step 3: Test Laravel database connection (if vendor exists)
if (file_exists($basePath . '/vendor/autoload.php')) {
    echo "Step 3: Testing Laravel database connection...\n";

    try {
        require $basePath . '/vendor/autoload.php';

        $app = require_once $basePath . '/bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();

        // Get database config
        $dbConfig = config('database.connections.mysql');

        echo "Laravel is configured to use:\n";
        echo "  Host: " . ($dbConfig['host'] ?? 'NOT SET') . "\n";
        echo "  Port: " . ($dbConfig['port'] ?? 'NOT SET') . "\n";
        echo "  Database: " . ($dbConfig['database'] ?? 'NOT SET') . "\n";
        echo "  Username: " . ($dbConfig['username'] ?? 'NOT SET') . "\n";
        echo "  Password: " . (isset($dbConfig['password']) ? str_repeat('*', strlen($dbConfig['password'])) : 'NOT SET') . "\n\n";

        // Check if config matches .env
        $matches = true;
        if ($dbConfig['host'] !== $envValues['DB_HOST']) {
            echo "⚠ WARNING: Host mismatch!\n";
            echo "  .env: {$envValues['DB_HOST']}\n";
            echo "  Laravel config: {$dbConfig['host']}\n";
            $matches = false;
        }

        if ($dbConfig['database'] !== $envValues['DB_DATABASE']) {
            echo "⚠ WARNING: Database mismatch!\n";
            echo "  .env: {$envValues['DB_DATABASE']}\n";
            echo "  Laravel config: {$dbConfig['database']}\n";
            $matches = false;
        }

        if ($dbConfig['username'] !== $envValues['DB_USERNAME']) {
            echo "⚠ WARNING: Username mismatch!\n";
            echo "  .env: {$envValues['DB_USERNAME']}\n";
            echo "  Laravel config: {$dbConfig['username']}\n";
            $matches = false;
        }

        if (!$matches) {
            echo "\n❌ Configuration cached! Run: php clear-all-caches.php\n\n";
        } else {
            echo "✓ Laravel configuration matches .env file\n\n";
        }

        // Test actual connection through Laravel
        try {
            $pdo = DB::connection()->getPdo();
            echo "✓ Laravel database connection successful!\n";
        } catch (Exception $e) {
            echo "❌ Laravel database connection failed: " . $e->getMessage() . "\n";
        }

    } catch (Exception $e) {
        echo "⚠ Could not test Laravel connection: " . $e->getMessage() . "\n";
    }
} else {
    echo "Step 3: Skipped (vendor directory not found)\n";
}

echo "\n=== Diagnostic Complete ===\n\n";

echo "Summary:\n";
if (isset($pdo) && $pdo) {
    echo "✓ Database connection is working\n";

    if ($sessionsExists) {
        echo "✓ Sessions table exists\n";
        echo "\nYour application should work now!\n";
    } else {
        echo "⚠ Sessions table does not exist\n";
        echo "\nNext step: Run migrations\n";
        echo "Command: php run-migrations-safe.php\n";
    }
} else {
    echo "❌ Database connection is NOT working\n";
    echo "\nFix the connection error and try again\n";
}

echo "\nCleanup: rm test-db-connection.php\n";
