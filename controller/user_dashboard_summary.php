<?php
require_once "conn.php";

$response = [
    "totalRepairRequests" => 0,
    "totalReservations" => 0,
    "totalInventoryItems" => 0,
];

// Fetch total job orders
$result = $conn->query("SELECT COUNT(*) AS count FROM repair_requests");
if ($result) {
    $response["totalRepairRequests"] = $result->fetch_assoc()["count"];
} else {
    $response["error"] = "Failed to fetch total repair requests: " . $conn->error;
}

// Fetch total reservations
$result = $conn->query("SELECT COUNT(*) AS count FROM reservations");
if ($result) {
    $response["totalReservations"] = $result->fetch_assoc()["count"];
} else {
    $response["error"] = "Failed to fetch total reservations: " . $conn->error;
}
// Fetch total inventory items
$result = $conn->query("SELECT COUNT(*) AS count FROM inventory");
if ($result) {
    $response["totalInventoryItems"] = $result->fetch_assoc()["count"];
}

echo json_encode($response);

$conn->close();
?>
