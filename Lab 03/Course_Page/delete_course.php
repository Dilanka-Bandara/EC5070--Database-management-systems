<?php
include 'config.php';
$code = $_GET['code'];

// Delete in proper order
$conn->query("DELETE FROM `Manage` WHERE Code='$code'");
$conn->query("DELETE FROM `Course` WHERE Ccode='$code'");
echo "🗑️ Course deleted successfully.";
?>
