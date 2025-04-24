<?php
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);
        $query = "SELECT id, full_name, email, role, course, year, password FROM clients WHERE id = $id"; // Include password
        $result = $conn->query($query);
        echo json_encode($result->fetch_assoc());
    } else {
        $query = "SELECT id, full_name, email, role, course, year, password FROM clients"; // Include password
        $result = $conn->query($query);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        echo json_encode($users);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];
    if ($action === "add") {
        $full_name = $_POST["full_name"];
        $email = $_POST["email"];
        $role = $_POST["role"];
        $course = $_POST["course"];
        $year = $_POST["year"];
        $password = $_POST["password"];
        $query = "INSERT INTO clients (full_name, email, password, role, course, year) VALUES ('$full_name', '$email', '$password', '$role', '$course', '$year')";
        $conn->query($query);
    } elseif ($action === "edit") {
        $id = intval($_POST["id"]);
        $full_name = $_POST["full_name"];
        $email = $_POST["email"];
        $role = $_POST["role"];
        $course = $_POST["course"];
        $year = $_POST["year"];
        $password = $_POST["password"]; // Get password
        $query = "UPDATE clients SET full_name = '$full_name', email = '$email', role = '$role', course = '$course', year = '$year', password = '$password' WHERE id = $id"; // Update password
        $conn->query($query);
    } elseif ($action === "delete") {
        $id = intval($_POST["id"]);
        $query = "DELETE FROM clients WHERE id = $id";
        $conn->query($query);
    }
}

$conn->close();
?>
