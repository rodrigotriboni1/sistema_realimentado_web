<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Starting debug...<br>";

if (!file_exists('db_connect.php')) {
    die("Error: db_connect.php not found.");
}

require 'db_connect.php';
echo "Database connection successful.<br>";

try {
    echo "Checking tables...<br>";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "No tables found in database '$dbname'.<br>";
    } else {
        echo "Tables found: " . implode(", ", $tables) . "<br>";
        
        if (in_array('measurements', $tables)) {
            echo "Table 'measurements' exists.<br>";
            $stmt = $pdo->query("SELECT count(*) FROM measurements");
            echo "Rows in 'measurements': " . $stmt->fetchColumn() . "<br>";
            
            echo "Testing query from get_data.php...<br>";
            $stmtLatest = $pdo->query("SELECT * FROM measurements ORDER BY timestamp DESC LIMIT 1");
            $latest = $stmtLatest->fetch(PDO::FETCH_ASSOC);
            echo "Latest data fetch: " . ($latest ? "Success" : "No data") . "<br>";
        } else {
            echo "<strong style='color:red'>Table 'measurements' DOES NOT exist. Please import database.sql.</strong><br>";
        }
    }
    
} catch (PDOException $e) {
    echo "<strong style='color:red'>PDO Error: " . $e->getMessage() . "</strong>";
} catch (Exception $e) {
    echo "<strong style='color:red'>General Error: " . $e->getMessage() . "</strong>";
}
?>
