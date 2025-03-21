<?php include 'db.php'; ?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>College Database</title> 
    <link rel="stylesheet" href="style.css"> 
</head> 
<body> 
    <h1>Welcome to the College Database</h1> 
    <nav> 
        <!-- View elements -->
        <a href="view_courses.php">View Courses</a> 
        
        <a href="view_students.php">View Students</a> 
        
        <!-- insertiion stuff -->
        <a href="add_student.php">Add Student</a> 
        <a href="enroll_student.php">Enroll Student in Course</a> 
        
        <!-- more complex feature -->
        <a href="course_statistics.php">Course Enrollment Statistics</a> 
        
        <!-- quit Feature -->
        <a href="quit.php">Quit</a> 
    </nav> 
</body> 
</html>