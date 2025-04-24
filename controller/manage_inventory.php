<?php
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);
        $query = "SELECT id, material_name, category, quantity_available, `condition`, location, status FROM inventory WHERE id = $id";
        $result = $conn->query($query);
        echo json_encode($result->fetch_assoc());
    } else {
        $query = "SELECT id, material_name, category, quantity_available, `condition`, location, status FROM inventory";
        $result = $conn->query($query);
        $inventory = [];
        while ($row = $result->fetch_assoc()) {
            $inventory[] = $row;
        }
        echo json_encode($inventory);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];
    if ($action === "add") {
        $material_name = $_POST["material_name"];
        $category = $_POST["category"];
        $quantity_available = intval($_POST["quantity_available"]);
        $condition = $_POST["condition"];
        $location = $_POST["location"];
        $status = $_POST["status"];
        $query = "INSERT INTO inventory (material_name, category, quantity_available, `condition`, location, status) 
                  VALUES ('$material_name', '$category', $quantity_available, '$condition', '$location', '$status')";
        $conn->query($query);
    } elseif ($action === "edit") {
        $id = intval($_POST["id"]);
        $material_name = $_POST["material_name"];
        $category = $_POST["category"];
        $quantity_available = intval($_POST["quantity_available"]);
        $condition = $_POST["condition"];
        $location = $_POST["location"];
        $status = $_POST["status"];
        $query = "UPDATE inventory SET material_name = '$material_name', category = '$category', 
                  quantity_available = $quantity_available, `condition` = '$condition', location = '$location', 
                  status = '$status' WHERE id = $id";
        $conn->query($query);
    } elseif ($action === "delete") {
        $id = intval($_POST["id"]);
        $query = "DELETE FROM inventory WHERE id = $id";
        $conn->query($query);
    } elseif ($action === "request") {
        $id = intval($_POST["id"]);
        $query = "UPDATE inventory SET status = 'In Use' WHERE id = $id";
        $conn->query($query);
    }
}

$conn->close();
?>
