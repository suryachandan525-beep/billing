<?php
require_once "../db.php";

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_POST['id'];

$stmt = $conn->prepare(
    "UPDATE customers SET status = 'archived' WHERE id = ?"
);

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
}

echo "Archive failed!";
?>