<?php
// db_connect.php - Database connection file

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "student_mangement";

$conn = new mysqli($host, $user, $password, $database);


// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
