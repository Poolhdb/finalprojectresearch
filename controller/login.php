<?php
require_once 'conn.php'; // Include the database connection

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to check if the user exists
    $query = "SELECT * FROM admin_users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Debugging: Log the stored hashed password
        // error_log("Stored hashed password: " . $user['password']);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo json_encode([
                "status" => "success",
                "redirect" => "pages/admin/dashboard.php"
            ]);
        } else {
            // Debugging: Log password verification failure
            // error_log("Password verification failed for user: $username");

            echo json_encode([
                "status" => "error",
                "message" => "Invalid password."
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "User not found."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method."
    ]);
}

$conn->close();
?>
