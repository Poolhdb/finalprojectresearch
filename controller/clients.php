<?php
require_once "conn.php"; // Include the database connection

header("Content-Type: application/json");

try {
    // Query to fetch all clients
    $query = "SELECT id, full_name, email, created_at FROM clients";
    $result = $conn->query($query);

    if (!$result) {
        throw new Exception("Error fetching clients: " . $conn->error);
    }

    $clients = [];
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }

    echo json_encode(["status" => "success", "data" => $clients]);
} catch (Exception $e) {
    error_log($e->getMessage()); // Log the error for debugging
    echo json_encode(["status" => "error", "message" => "Failed to fetch clients."]); // Generic error message
}

$conn->close();
?>
