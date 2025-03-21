<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $enrollment_year = $_POST["enrollment_year"];

    // Validating the enrollment year #####################################################
    if ($enrollment_year < 2000 || $enrollment_year > 2025) {
        die("Error: Invalid enrollment year. Please enter a year between 2000 and 2025.");
    
    }

    // implementing a check to see if the email already exisist before even trying to insert it into the databse
    $check_email_sql = "SELECT * FROM Students WHERE email = '$email'";
    
    $result = $conn->query($check_email_sql);
    
    if ($result->num_rows > 0) {
        die("Error: A student with this email already exists.");
    }

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