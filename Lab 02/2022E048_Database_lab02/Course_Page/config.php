<?php
$host = "localhost";
$user = "root";
$pass = ""; // If you have a MySQL password, enter it here
$dbname = "course_manager2";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
