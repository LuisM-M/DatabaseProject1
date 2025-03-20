<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add Student</h1>
    <form action="add_student_process.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="enrollment_year">Enrollment Year:</label>
        <input type="number" id="enrollment_year" name="enrollment_year" required>
        
        <button type="submit">Add Student</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>