<?php
$conn = new mysqli("localhost", "root", "", "course_manager2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
