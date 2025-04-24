<?php
require_once '../../controller/conn.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Replace with the actual logged-in user ID
    $user_id = 1; // Example user ID

    // Retrieve form data
    $requester_name = $conn->real_escape_string($_POST['requester_name']);
    $department = $conn->real_escape_string($_POST['department']);
    $location = $conn->real_escape_string($_POST['location']);
    $service_type = $conn->real_escape_string($_POST['service_type']);
    $description = $conn->real_escape_string($_POST['description']);
    $priority = $conn->real_escape_string($_POST['priority']);
    $date_requested = $conn->real_escape_string($_POST['date_requested']);

    // Handle file upload
    $attachment = null;
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../uploads/';
        $file_name = basename($_FILES['attachment']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {
            $attachment = $file_name; // Store only the file name
        }
    }

    // Insert data into the database with user_id
    $sql = "INSERT INTO repair_requests (user_id, requester_name, department, location, service_type, description, priority, attachment, date_requested, status)
            VALUES ('$user_id', '$requester_name', '$department', '$location', '$service_type', '$description', '$priority', '$attachment', '$date_requested', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        header("Location: request_repair.php?success=1"); // Redirect with success message
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
