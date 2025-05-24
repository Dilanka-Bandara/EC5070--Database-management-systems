<?php
include 'config.php';
$code = $_GET['code'];
$conn->query("DELETE FROM manage WHERE Code='$code'");
$conn->query("DELETE FROM course WHERE Ccode='$code'");
echo "Deleted successfully.";
?>
