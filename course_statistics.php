<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Enrollment Statistics</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Course Enrollment Statistics</h1>
    <table>
        <thead>
            <tr>
                <th>Course Title</th>
                <th>Number of Students</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch course enrollment statistics
            $sql = "SELECT c.title, COUNT(e.student_id) AS num_students 
                    FROM Courses c 
                    LEFT JOIN Enrollments e ON c.course_id = e.course_id 
                    GROUP BY c.course_id";
            $result = $conn->query($sql);
            
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['title']}</td>
                        <td>{$row['num_students']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php">Back to Home</a>
</body>
</html>