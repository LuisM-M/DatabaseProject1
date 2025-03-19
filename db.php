<?php

    // require_once 'vendor/autoload.php';

    // Dotenv\Dotenv::createImmutable(__DIR__)->load();

    $host = getenv("DB_HOST");
    $username = getenv("DB_USER");
    $password = getenv("DB_PASS");
    $database = getenv("DB_NAME");

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>