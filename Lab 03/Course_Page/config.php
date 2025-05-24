<?php
// Enable detailed MySQLi error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database credentials
$host = "localhost";
$user = "root";
$pass = "DilA@2001";  // Leave blank if you're using default XAMPP MySQL setup
$dbname = "course_manager2";

try {
    // Create a new MySQLi connection
    $conn = new mysqli($host, $user, $pass, $dbname);
    // Set the charset (optional but recommended)
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    // If there's an error, show a clean message
    die("Database connection failed: " . $e->getMessage());
}
?>
