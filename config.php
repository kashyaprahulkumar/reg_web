<?php
// Start the session for login/logout functionality
session_start();

// Database connection details
$servername = "db";
$username = "root"; // your MySQL username
$password = "rajree"; // your MySQL password
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>