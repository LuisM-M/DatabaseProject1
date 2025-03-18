<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department and Courses</title>
    <script>
        // Function to load courses based on selected department
        function loadCourses() {
            var departmentId = document.getElementById("Department").value;
            
            // If no department is selected, clear the courses drop-down
            if (departmentId === "") {
                document.getElementById("Courses").innerHTML = "<option>Select a department first</option>";
                return;
            }

            // Create a request to fetch courses based on the department
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_courses.php?dept_id=" + departmentId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("Courses").innerHTML = xhr.responseText;
                }
            }
            xhr.send();
        }
    </script>
</head>
<body>
    <h1>Select Department and Course</h1>

    <!-- Department Drop-Down -->
    <label for="Department">Select Department:</label>
    <select id="Department" onchange="loadCourses()">
        <option value="">-- Select Department --</option>
        <?php
        // Fetch departments from the database
        $sql = "SELECT * FROM Departments";
        $result = $conn->query($sql);
        
        while($row = $result->fetch_assoc()) {
            echo "<option value='{$row['dept_id']}'>{$row['name']}</option>";
        }
        ?>
    </select>

    <!-- Course Drop-Down -->
    <label for="Courses">Select Course:</label>
    <select id="Courses">
        <option>Select a department first</option>
    </select>

</body>
</html>
