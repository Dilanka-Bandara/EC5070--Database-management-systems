<?php
include 'config.php';
$semester = $_GET['semester'];
$sql = "SELECT c.Ccode, c.Cname, c.Credit, c.LecHours FROM course c 
        JOIN manage m ON c.Ccode = m.Code 
        WHERE m.Semester = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $semester);
$stmt->execute();
$result = $stmt->get_result();

echo "<table border='1'><tr><th>Code</th><th>Name</th><th>Credit</th><th>Lecture Hours</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['Ccode']}</td><td>{$row['Cname']}</td><td>{$row['Credit']}</td><td>{$row['LecHours']}</td></tr>";
}
echo "</table>";
?>
