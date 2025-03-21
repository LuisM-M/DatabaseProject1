<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Instructor Details</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $instructor_id = $_POST["instructor_id"];

        // Query to retrieve instructor details //////////
        $sql = "SELECT i.name, d.name, c.title
                FROM Instructors i
                JOIN Departments d ON i.department_id = d.department_id
                LEFT JOIN Courses c ON i.instructor_id = c.instructor_id
                WHERE i.instructor_id = $instructor_id";
                
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h2>Instructor: {$row['name']}</h2>"; // First 'name' column (instructor's name)
            echo "<p><strong>Department:</strong> {$row['name']}</p>"; // Second 'name' column (department's name)

            // Display courses taught by the instructor
            echo "<h3>Courses Taught:</h3>";
            if ($row['title']) {
                echo "<ul>";
                do {
                    echo "<li>{$row['title']}</li>";
                } while ($row = $result->fetch_assoc());
                echo "</ul>";
            } else {
                // in case the processor is not teaching courses
                echo "<p>This instructor is not currently teaching any courses.</p>";
            }
        } else {
            // error message
            echo "<p>No instructor found with the selected ID.</p>";
        }
    } else {
        // error handling


        echo "<p>Invalid request. Please select an instructor from the <a href='view_instructor.php'>Instructor List</a>.</p>";
    }
    ?>
    <a href="index.php">Back to Home</a>
</body>
</html>