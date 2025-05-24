<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codes = $_POST['code'];
    $names = $_POST['name'];
    $credits = $_POST['credit'];
    $hours = $_POST['hours'];
    $managers = $_POST['manager'];
    $semester = $_POST['semester'];

    foreach ($codes as $i => $code) {
        $name = $names[$i];
        $credit = $credits[$i];
        $hour = $hours[$i];
        $manager = $managers[$i];

        // Insert into Course table (if not exists)
        $stmt = $conn->prepare("INSERT IGNORE INTO Course (Ccode, Cname, Credit, LecHours) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $code, $name, $credit, $hour);
        $stmt->execute();

        // Insert into MA table (if not exists)
        $stmt2 = $conn->prepare("INSERT IGNORE INTO MA (MID, Mname) VALUES (?, ?)");
        $stmt2->bind_param("ss", $manager, $manager); // assuming MID = name
        $stmt2->execute();

        // Insert into Manage table
        $stmt3 = $conn->prepare("REPLACE INTO Manage (Code, MAid, Semester) VALUES (?, ?, ?)");
        $stmt3->bind_param("ssi", $code, $manager, $semester);
        $stmt3->execute();
    }

    echo "✅ Courses saved successfully!";
} else {
    echo "❌ Invalid request.";
}
?>
