<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Instructor Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>View Instructor Details</h1>
    <form action="view_instructor_process.php" method="POST">
        <label for="instructor_id">Select Instructor:</label>
        <select id="instructor_id" name="instructor_id" required>
            <option value="">-- Select Instructor --</option>
            <?php
            // Retrieve all instructors from the database
            $sql = "SELECT instructor_id, name FROM Instructors";
            $result = $conn->query($sql);

            // Populate the dropdown with instructor names
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['instructor_id']}'>{$row['name']}</option>";
            }
            ?>
        </select>
        <button type="submit">View Details</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>