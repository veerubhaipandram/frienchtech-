<?php
// Step 1: Establish a connection to the MySQL database
$servername = "localhost"; // Change this to your MySQL server address
$username = "root"; // Change this to your MySQL username
$password = "Veeru@12345"; // Change this to your MySQL password
$database = "frienchtech_db"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>