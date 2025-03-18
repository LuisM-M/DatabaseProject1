<?php
    // Get Heroku database credentials
    $host = getenv("DB_HOST");
    $username = getenv("DB_USER");
    $password = getenv("DB_PASS");
    $database = getenv("DB_NAME");

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>