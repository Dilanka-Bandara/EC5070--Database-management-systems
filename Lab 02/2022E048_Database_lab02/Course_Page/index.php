<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0eafc, #cfdef3);
        }
        .card {
            border-radius: 20px;
        }
        .btn-custom {
            border-radius: 30px;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold"> ♨️FACULTY OF ENGINEERING UNIVERSITY OF JAFFNA♨️</h2>
        <h2 class="fw-bold">🎓 Course Management System </h2>
        <p class="text-muted">Add, Edit, Delete Courses by Semester</p>
    </div>

    <div class="mb-4">
        <label class="form-label">Select Semester:</label>
        <select class="form-select w-25" id="semesterSelect">
            <?php for ($i = 1; $i <= 8; $i++): ?>
                <option value="<?= $i ?>">Semester <?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="card shadow p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">📋 Course List</h5>
            <button class="btn btn-success btn-sm btn-custom" id="addRow">➕ Add New Course</button>
        </div>
        <form id="courseForm">
            <table class="table table-bordered table-hover bg-white" id="courseTable">
                <thead class="table-dark">
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Credit</th>
                        <th>Lecture Hours</th>
                        <th>Manager</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="submit" class="btn btn-primary btn-custom">💾 Save</button>
        </form>
    </div>
</div>

<script>
const semesterSelect = document.getElementById("semesterSelect");
const courseTableBody = document.querySelector("#courseTable tbody");

function loadCourses() {
    const semester = semesterSelect.value;
    fetch("get_courses.php?semester=" + semester)
        .then(res => res.json())
        .then(data => {
            courseTableBody.innerHTML = "";
            data.forEach(course => {
                courseTableBody.innerHTML += `
                    <tr data-id="${course.Ccode}">
                        <td><input type="text" name="code[]" class="form-control" value="${course.Ccode}" readonly></td>
                        <td><input type="text" name="name[]" class="form-control" value="${course.Cname}"></td>
                        <td><input type="number" name="credit[]" class="form-control" value="${course.Credit}"></td>
                        <td><input type="number" name="hours[]" class="form-control" value="${course.LecHours}"></td>
                        <td><input type="text" name="manager[]" class="form-control" value="${course.Mname}"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteCourse('${course.Ccode}')">🗑️ Delete</button>
                        </td>
                    </tr>`;
            });
        });
}

function deleteCourse(code) {
    if (!confirm("Are you sure you want to delete this course?")) return;
    fetch("delete_course.php?code=" + code)
        .then(res => res.text())
        .then(alert)
        .then(loadCourses);
}

document.getElementById("addRow").addEventListener("click", function () {
    courseTableBody.insertAdjacentHTML("beforeend", `
        <tr>
            <td><input type="text" name="code[]" class="form-control" required></td>
            <td><input type="text" name="name[]" class="form-control" required></td>
            <td><input type="number" name="credit[]" class="form-control" required></td>
            <td><input type="number" name="hours[]" class="form-control" required></td>
            <td><input type="text" name="manager[]" class="form-control" required></td>
            <td><span class="text-secondary">New</span></td>
        </tr>`);
});

document.getElementById("courseForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append("semester", semesterSelect.value);

    fetch("add_course.php", {
        method: "POST",
        body: formData
    }).then(res => res.text())
      .then(msg => {
        alert(msg);
        loadCourses();
        this.reset(); // optional: remove if you don’t want to clear all rows
    });
});

semesterSelect.addEventListener("change", loadCourses);
loadCourses();
</script>
</body>
</html>
