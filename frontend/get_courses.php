<?php
include 'db.php';

// Check if the department ID is set
if (isset($_GET['dept_id'])) {
    $departmentId = $_GET['dept_id'];

    // Fetch courses for the selected department
    $sql = "SELECT * FROM Courses WHERE dept_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $departmentId);  // Bind the department ID parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if courses are available
    if ($result->num_rows > 0) {
        // Output courses as options
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['course_id']}'>{$row['title']}</option>";
        }
    } else {
        echo "<option>No courses available for this department</option>";
    }

    $stmt->close();
}
?>
