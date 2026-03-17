<?php
// db_connect.php

$servername = "localhost";
$username = "root"; // Default XAMPP/WAMP username
$password = "";     // Default XAMPP/WAMP password (usually empty)
$dbname = "MedicalPlatform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to utf8mb4 for proper text rendering (important for medical text)
$conn->set_charset("utf8mb4");
?>