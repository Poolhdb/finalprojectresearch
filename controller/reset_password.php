<?php
require_once "conn.php"; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $conn->real_escape_string($_POST["email"]);

    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email address."]);
        exit;
    }

    // Check if email exists
    $checkEmailQuery = "SELECT id FROM clients WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if (!$result) {
        error_log("Error checking email: " . $conn->error); // Log the error
        echo json_encode(["status" => "error", "message" => "An error occurred while checking the email."]);
        exit;
    }

    if ($result->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Email not found."]);
        exit;
    }

    // Generate a reset token
    $resetToken = bin2hex(random_bytes(16));
    $expiryTime = date("Y-m-d H:i:s", strtotime("+1 hour"));

    // Store the reset token in the database
    $storeTokenQuery = "UPDATE clients SET reset_token = '$resetToken', reset_token_expiry = '$expiryTime' WHERE email = '$email'";
    if ($conn->query($storeTokenQuery) === TRUE) {
        // Send the reset token to the user's email (mocked here)
        echo json_encode(["status" => "success", "message" => "Password reset link has been sent to your email."]);
    } else {
        error_log("Error storing reset token: " . $conn->error); // Log the error
        echo json_encode(["status" => "error", "message" => "An error occurred while processing your request."]);
    }
}

$conn->close();
?>
