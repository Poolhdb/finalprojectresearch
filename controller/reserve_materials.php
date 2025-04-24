<?php
session_start(); // Ensure this is the first line of the file
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0; // Get the logged-in user's ID
    $requester_name = $conn->real_escape_string($_POST["requester_name"]);
    $department = $conn->real_escape_string($_POST["department"]);
    $material_name = $conn->real_escape_string($_POST["material"]);
    $quantity = intval($_POST["quantity"]);
    $purpose = $conn->real_escape_string($_POST["purpose"]);
    $date_needed = $conn->real_escape_string($_POST["date_needed"]);
    $return_date = $conn->real_escape_string($_POST["return_date"]);

    // Insert reservation into the database with a default status of 'Pending'
    $query = "INSERT INTO reservations (user_id, requester_name, department, material_name, quantity, purpose, date_needed, return_date, status) 
              VALUES ($user_id, '$requester_name', '$department', '$material_name', $quantity, '$purpose', '$date_needed', '$return_date', 'Pending')";

    if ($conn->query($query) === TRUE) {
        // Redirect with success message
        header("Location: ../pages/user/my_reservations.php?success=1");
    } else {
        // Redirect with error message
        header("Location: ../pages/user/my_reservations.php?error=1");
    }
}

$conn->close();
?>
