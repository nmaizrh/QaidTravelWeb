<?php
// db_connect.php

$servername = "localhost:3301"; // Usually 'localhost' if your PHP and MySQL are on the same server
$username = "root";        // Your MySQL username (often 'root' for development)
$password = "";            // Your MySQL password (empty by default for XAMPP/WAMP root)
$dbname = "qaidtravel"; // The name of the database you will create in phpMyAdmin

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to UTF-8 for proper display of special characters
$conn->set_charset("utf8mb4");

// You can now include this file in other PHP files that need database access.
// Example: include 'db_connect.php';
?>