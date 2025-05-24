<?php
include 'config.php';

$codes = $_POST['code'];
$names = $_POST['name'];
$credits = $_POST['credit'];
$hours = $_POST['hours'];
$managers = $_POST['manager'];
$semester = $_POST['semester'];

for ($i = 0; $i < count($codes); $i++) {
    $code = $conn->real_escape_string($codes[$i]);
    $name = $conn->real_escape_string($names[$i]);
    $credit = (int)$credits[$i];
    $lec = (int)$hours[$i];
    $mname = $conn->real_escape_string($managers[$i]);

    if (!$code || !$name || !$credit || !$lec || !$mname) continue;

    // Check for existing manager
    $res = $conn->query("SELECT MID FROM ma WHERE Mname = '$mname'");
    if ($res->num_rows > 0) {
        $maid = $res->fetch_assoc()['MID'];
    } else {
        $conn->query("INSERT INTO ma (Mname) VALUES ('$mname')");
        $maid = $conn->insert_id;
    }

    // Insert or update course
    $conn->query("INSERT INTO course (Ccode, Cname, Credit, LecHours) 
        VALUES ('$code', '$name', $credit, $lec)
        ON DUPLICATE KEY UPDATE 
            Cname = VALUES(Cname), 
            Credit = VALUES(Credit), 
            LecHours = VALUES(LecHours)");

    // Insert or update manage table
    $checkManage = $conn->query("SELECT * FROM manage WHERE Code='$code' AND Semester=$semester");
    if ($checkManage->num_rows > 0) {
        $conn->query("UPDATE manage SET MAid=$maid WHERE Code='$code' AND Semester=$semester");
    } else {
        $conn->query("INSERT INTO manage (Code, MAid, Semester) VALUES ('$code', $maid, $semester)");
    }
}

echo "✅ Course(s) saved or updated successfully.";
?>

