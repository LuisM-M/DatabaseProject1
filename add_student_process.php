<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $enrollment_year = $_POST["enrollment_year"];

    // Insert the new student into the database
    $sql = "INSERT INTO Students (name, email, enrollment_year) VALUES ('$name', '$email', $enrollment_year)";
    if ($conn->query($sql) === TRUE) {
        echo "New student added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<a href="index.php">Back to Home</a>