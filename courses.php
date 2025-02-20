<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Courses</h1>
    <table>
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Title</th>
                <th>Credits</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Courses";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['course_id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['credits']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No courses found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php">Back to Home</a>
</body>
</html>