<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "../db.php";

$customers = $conn->query("SELECT COUNT(*) AS total FROM customers")->fetch_assoc()['total'];
$products = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
$invoices = $conn->query("SELECT COUNT(*) AS total FROM invoices")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h2>

    <h3>Dashboard Summary</h3>

    <p>Total Customers: <?php echo $customers; ?></p>
    <p>Total Products: <?php echo $products; ?></p>
    <p>Total Invoices: <?php echo $invoices; ?></p>

    <hr>

    <h3>Management</h3>

    <a href="../customers/index.php">Customer Management</a>
    <br><br>

    <a href="products/index.php">Product Management</a>
    <br><br>

    <a href="invoices/index.php">Invoice Management</a>
    <br><br>

    <a href="logout.php">Logout</a>

</body>
</html>
