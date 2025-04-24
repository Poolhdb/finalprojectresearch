<?php
// Replace 'your_password_here' with the password you want to hash
$password = 'admin';

// Generate a hashed password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo "Hashed Password: " . $hashedPassword;
?>
