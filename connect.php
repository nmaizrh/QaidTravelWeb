<?php
// db_connect.php

$servername = "localhost:3301"; // Usually 'localhost' if your PHP and MySQL are on the same server
$username = "root";        // Your MySQL username (often 'root' for development)
$password = "1234";            // Your MySQL password (empty by default for XAMPP/WAMP root)
$dbname = "qaidtravel"; // The name of the database you will create in phpMyAdmin

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>