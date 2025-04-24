<?php
require_once '../../controller/conn.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $conn->real_escape_string($_POST['id']);
    $status = $conn->real_escape_string($_POST['status']);

    // Update the status of the repair request
    $sql = "UPDATE repair_requests SET status = '$status' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Fetch the user ID associated with the repair request
        $user_query = "SELECT user_id FROM repair_requests WHERE id = $id";
        $user_result = $conn->query($user_query);

        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $user_id = $user_row['user_id'];

            // Create a notification for the user
            $message = "Your repair request (ID: $id) has been updated to '$status'.";
            $notif_sql = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$message')";
            $conn->query($notif_sql);
        }

        header("Location: manage_job_orders.php?success=1"); // Redirect with success message
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
