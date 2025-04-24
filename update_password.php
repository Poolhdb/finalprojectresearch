<?php
include 'controller/conn.php'; // Include your database connection file

$newPassword = 'admin'; // Replace with the desired password
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$sql = "UPDATE users SET password = ? WHERE username = 'admin'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hashedPassword);

if ($stmt->execute()) {
    echo "Password updated successfully!";
} else {
    echo "Error updating password: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
