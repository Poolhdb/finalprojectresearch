<?php
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate inputs
    if (empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Email and password are required."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit;
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, password FROM clients WHERE email = ?");
    if (!$stmt) {
        error_log("Prepared statement failed: " . $conn->error);
        echo json_encode(["status" => "error", "message" => "An error occurred while processing your request."]);
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        error_log("Database query failed: " . $conn->error); // Log the error
        echo json_encode(["status" => "error", "message" => "An error occurred while processing your request."]);
        exit;
    }

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user["password"]) { // Compare plain text passwords directly
            echo json_encode(["status" => "success", "message" => "Login successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Incorrect password."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Email not registered."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
$conn->close();
?>
