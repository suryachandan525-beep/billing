<?php
require_once "db.php";

$username = "admin";
$password = password_hash("Admin@123", PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO admins (username, password) VALUES (?, ?)"
);

$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "Admin created successfully";
} else {
    echo "Error creating admin: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
