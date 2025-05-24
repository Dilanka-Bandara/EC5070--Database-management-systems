<?php
include 'config.php';
$semester = $_GET['semester'];

$sql = "SELECT c.Ccode, c.Cname, c.Credit, c.LecHours, m.Mname
        FROM `Course` c
        JOIN `Manage` mg ON c.Ccode = mg.Code
        JOIN `MA` m ON mg.MAid = m.MID
        WHERE mg.Semester = ?";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $semester);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
?>
