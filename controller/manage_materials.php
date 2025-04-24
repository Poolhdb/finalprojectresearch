<?php
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]);
    $status = $conn->real_escape_string($_POST["status"]);

    // Fetch the current status for logging
    $currentStatusQuery = "SELECT status FROM reservations WHERE id = $id";
    $currentStatusResult = $conn->query($currentStatusQuery);
    if ($currentStatusResult && $currentStatusResult->num_rows > 0) {
        $currentStatus = $currentStatusResult->fetch_assoc()['status'];

        // Update the status of the reservation
        $query = "UPDATE reservations SET status = '$status' WHERE id = $id";
        if ($conn->query($query) === TRUE) {
            // Log the status change
            $logQuery = "INSERT INTO status_logs (reservation_id, old_status, new_status, changed_at) 
                         VALUES ($id, '$currentStatus', '$status', NOW())";
            $conn->query($logQuery);

            // Update pending reservations count if status is "Pending"
            if ($status === 'Pending') {
                $updatePendingQuery = "UPDATE reservations SET status = 'Pending' WHERE id = $id";
                $conn->query($updatePendingQuery);
            }

            echo json_encode(["success" => true, "message" => "Status updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error updating status: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Reservation not found."]);
    }
}

$conn->close();
?>
