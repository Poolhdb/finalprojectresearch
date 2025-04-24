<?php
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = $conn->real_escape_string($_POST["fullName"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $role = $conn->real_escape_string($_POST["role"]);
    $course = $conn->real_escape_string($_POST["course"]);
    $year = $conn->real_escape_string($_POST["year"]);

    // Validate inputs
    if (empty($fullName) || empty($email) || empty($password) || empty($role) || empty($course) || empty($year)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit;
    }

    if (strlen($password) < 8) {
        echo json_encode(["status" => "error", "message" => "Password must be at least 8 characters long."]);
        exit;
    }

    // Check if email already exists
    $checkEmailQuery = "SELECT id FROM clients WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if (!$result) {
        error_log("Error checking email: " . $conn->error);
        echo json_encode(["status" => "error", "message" => "An error occurred while checking the email."]);
        exit;
    }

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email is already registered."]);
        exit;
    }

    // Insert new user into the database
    $insertQuery = "INSERT INTO clients (full_name, email, password, role, course, year) VALUES ('$fullName', '$email', '$password', '$role', '$course', '$year')";

    if ($conn->query($insertQuery) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Registration successful!"]);
    } else {
        error_log("Error inserting user: " . $conn->error);
        echo json_encode(["status" => "error", "message" => "An error occurred while registering."]);
    }
}
$conn->close();
?>
