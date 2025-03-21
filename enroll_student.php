<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll Student in Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Enroll Student in Course</h1>
    <form action="enroll_student_process.php" method="POST">
        <label for="student_id">Student:</label>
        <select id="student_id" name="student_id" required>
            <option value="">-- Select Student --</option>
            <?php
            $sql = "SELECT * FROM Students";
            $result = $conn->query($sql);
            
            // displaying each student into a dropdown
            while($row = $result->fetch_assoc()) {
                echo "<option value='{$row['student_id']}'>{$row['name']}</option>";
            }
            ?>
        </select>
        
        <label for="course_id">Course:</label>
        <select id="course_id" name="course_id" required>
            <option value="">-- Select Course --</option>
            <?php
            $sql = "SELECT * FROM Courses";
            $result = $conn->query($sql);
            
            // displaying each course into a dropdown ////////////
            while($row = $result->fetch_assoc()) {
                echo "<option value='{$row['course_id']}'>{$row['title']}</option>";
            }
            ?>
        </select>
        
        <!-- submit button to enroll the student -->
        <button type="submit">Enroll Student</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>