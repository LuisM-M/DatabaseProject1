<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_id = $_POST["course_id"];

    // checking to see if the student is already enrolled in the course #####

    $check_enrollment_sql = "SELECT * FROM Enrollments WHERE student_id = $student_id AND course_id = $course_id";
    $result = $conn->query($check_enrollment_sql);

    if ($result->num_rows > 0) {
        die("Error: This student is already enrolled in the selected course.");
    }

    //////////////////////////////// Insert enrollement ////////////////////////

    $sql = "INSERT INTO Enrollments (student_id, course_id, enrollment_date) VALUES ($student_id, $course_id, NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "Student enrolled successfully!";
    } else {
        // return error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<a href="index.php">Back to Home</a>