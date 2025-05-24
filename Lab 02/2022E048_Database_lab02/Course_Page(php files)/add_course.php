<?php
include 'config.php';

$semester = $_POST['semester'];
$codes = $_POST['ccode'];
$names = $_POST['cname'];
$credits = $_POST['credit'];
$hours = $_POST['hours'];

for ($i = 0; $i < count($codes); $i++) {
    $code = $codes[$i];
    $name = $names[$i];
    $credit = $credits[$i];
    $lecHours = $hours[$i];

    $conn->query("INSERT INTO course (Ccode, Cname, Credit, LecHours) VALUES ('$code', '$name', $credit, $lecHours)");
    $conn->query("INSERT INTO manage (Code, MAid, Semester) VALUES ('$code', 1, $semester)");
}

header("Location: index.php");
?>
