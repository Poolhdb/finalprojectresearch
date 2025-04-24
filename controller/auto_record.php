<?php
require_once "conn.php";

try {
    $current_date = date('Y-m-d');

    // Fetch all user IDs
    $users_query = "SELECT DISTINCT id AS user_id FROM users";
    $users_result = $conn->query($users_query);

    if ($users_result->num_rows > 0) {
        while ($user = $users_result->fetch_assoc()) {
            $user_id = intval($user['user_id']);

            // Count pending repairs
            $pending_repairs_query = "SELECT COUNT(*) AS count FROM repair_requests WHERE user_id = $user_id AND status = 'Pending'";
            $pending_repairs_result = $conn->query($pending_repairs_query);
            $pending_repairs_count = $pending_repairs_result->fetch_assoc()['count'] ?? 0;

            // Count active reservations
            $active_reservations_query = "SELECT COUNT(*) AS count FROM reservations WHERE user_id = $user_id AND status IN ('Pending', 'Approved', 'In Progress')";
            $active_reservations_result = $conn->query($active_reservations_query);
            $active_reservations_count = $active_reservations_result->fetch_assoc()['count'] ?? 0;

            // Count approved requests
            $approved_requests_query = "SELECT COUNT(*) AS count FROM repair_requests WHERE user_id = $user_id AND status = 'Approved'";
            $approved_requests_result = $conn->query($approved_requests_query);
            $approved_requests_count = $approved_requests_result->fetch_assoc()['count'] ?? 0;

            // Count rejected requests
            $rejected_requests_query = "SELECT COUNT(*) AS count FROM repair_requests WHERE user_id = $user_id AND status = 'Rejected'";
            $rejected_requests_result = $conn->query($rejected_requests_query);
            $rejected_requests_count = $rejected_requests_result->fetch_assoc()['count'] ?? 0;

            // Insert or update metrics in the dashboard_metrics table
            $metrics_query = "INSERT INTO dashboard_metrics (user_id, pending_repairs, active_reservations, approved_requests, rejected_requests, updated_at)
                              VALUES ($user_id, $pending_repairs_count, $active_reservations_count, $approved_requests_count, $rejected_requests_count, '$current_date')
                              ON DUPLICATE KEY UPDATE 
                              pending_repairs = $pending_repairs_count, 
                              active_reservations = $active_reservations_count, 
                              approved_requests = $approved_requests_count, 
                              rejected_requests = $rejected_requests_count, 
                              updated_at = '$current_date'";

            if (!$conn->query($metrics_query)) {
                error_log("Error updating metrics for user_id $user_id: " . $conn->error);
            }
        }
    } else {
        error_log("No users found to update metrics.");
    }

    echo "Dashboard metrics updated successfully.";
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
}

$conn->close();
?>
