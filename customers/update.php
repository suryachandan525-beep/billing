<?php
require_once "..db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$address = $_POST['address'];

$sql = "UPDATE customers
        SET name = ?, mobile = ?, email = ?, address = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $name, $mobile, $email, $address, $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>