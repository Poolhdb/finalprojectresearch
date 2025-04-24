<?php
require_once "conn.php";

$response = [
    "totalJobOrders" => 0,
    "totalReservations" => 0,
    "totalInventoryItems" => 0,
    "totalUsers" => 0
];

// Fetch total job orders
$result = $conn->query("SELECT COUNT(*) AS count FROM repair_requests");
if ($result) {
    $response["totalJobOrders"] = $result->fetch_assoc()["count"];
}

// Fetch total reservations
$result = $conn->query("SELECT COUNT(*) AS count FROM reservations");
if ($result) {
    $response["totalReservations"] = $result->fetch_assoc()["count"];
}

// Fetch total inventory items
$result = $conn->query("SELECT COUNT(*) AS count FROM inventory");
if ($result) {
    $response["totalInventoryItems"] = $result->fetch_assoc()["count"];
}

// Fetch total users
$result = $conn->query("SELECT COUNT(*) AS count FROM clients");
if ($result) {
    $response["totalUsers"] = $result->fetch_assoc()["count"];
}

echo json_encode($response);

$conn->close();
?>
