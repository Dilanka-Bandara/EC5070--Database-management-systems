<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Manager</title>
    <script>
        function loadCourses() {
            var sem = document.getElementById("semester").value;
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_courses.php?semester=" + sem, true);
            xhr.onload = function() {
                document.getElementById("courseList").innerHTML = this.responseText;
            };
            xhr.send();
        }

        function addRow() {
            let row = `<tr>
                <td><input type='text' name='ccode[]'></td>
                <td><input type='text' name='cname[]'></td>
                <td><input type='number' name='credit[]'></td>
                <td><input type='number' name='hours[]'></td>
            </tr>`;
            document.getElementById("newCourses").innerHTML += row;
        }
    </script>
</head>
<body>
    <h2>Course Management</h2>

    <label>Select Semester:</label>
    <select id="semester" onchange="loadCourses()">
        <?php
        $semQuery = "SELECT DISTINCT Semester FROM manage";
        $res = $conn->query($semQuery);
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['Semester']}'>{$row['Semester']}</option>";
        }
        ?>
    </select>

    <div id="courseList"></div>

    <h3>Add New Course</h3>
    <form method="POST" action="add_course.php">
        <input type="hidden" name="semester" value="" id="selectedSemester">
        <table border="1">
            <thead>
                <tr><th>Code</th><th>Name</th><th>Credit</th><th>Lecture Hours</th></tr>
            </thead>
            <tbody id="newCourses"></tbody>
        </table>
        <button type="button" onclick="addRow()">Add New Course</button>
        <button type="submit">Save</button>
    </form>
</body>
</html>
