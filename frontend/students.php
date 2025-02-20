<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Students</h1>
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Enrollment Year</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Students";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['student_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['enrollment_year']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No students found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php">Back to Home</a>
</body>
</html>