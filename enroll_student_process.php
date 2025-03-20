<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_id = $_POST["course_id"];

    // Insert the enrollment into the database
    $sql = "INSERT INTO Enrollments (student_id, course_id, enrollment_date) VALUES ($student_id, $course_id, NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "Student enrolled successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<a href="index.php">Back to Home</a>