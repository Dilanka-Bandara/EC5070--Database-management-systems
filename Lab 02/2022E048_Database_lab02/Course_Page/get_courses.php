<?php include 'config.php'; ?>

<?php
include 'config.php';
$semester = $_GET['semester'];
$sql = "SELECT c.Ccode, c.Cname, c.Credit, c.LecHours, m.Mname
        FROM course c
        JOIN manage mg ON c.Ccode = mg.Code
        JOIN ma m ON mg.MAid = m.MID
        WHERE mg.Semester = $semester";
$result = $conn->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
?>
