<?php
$host = "sql103.infinityfree.com";
$username = "if0_38816227";
$password = "hs23juSAbY";
$database = "if0_38816227_project1_db"; // Ensure this matches your actual database name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>