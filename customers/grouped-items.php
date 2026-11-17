<?php
require_once "../db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$customer_id = (int) $_GET['id'];

// Customer details
$stmt = $conn->prepare(
    "SELECT name FROM customers WHERE id = ?"
);

$stmt->bind_param("i", $customer_id);
$stmt->execute();

$customer = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$customer) {
    die("Customer not found");
}

// Grouped product list
$stmt = $conn->prepare(
    "SELECT
        invoice_items.product_name,
        SUM(invoice_items.quantity) AS total_quantity,
        SUM(invoice_items.total) AS total_purchase
     FROM invoices
     JOIN invoice_items
     ON invoices.id = invoice_items.invoice_id
     WHERE invoices.customer_id = ?
     GROUP BY invoice_items.product_id, invoice_items.product_name"
);

$stmt->bind_param("i", $customer_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<h2>Grouped Item List</h2>

<h3>Customer: <?php echo htmlspecialchars($customer['name']); ?></h3>

<table border="1" cellpadding="10">

<tr>
    <th>Product Name</th>
    <th>Total Quantity</th>
    <th>Total Purchase</th>
</tr>

<?php if ($result->num_rows > 0) { ?>

    <?php while ($row = $result->fetch_assoc()) { ?>

    <tr>
        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
        <td><?php echo $row['total_quantity']; ?></td>
        <td><?php echo $row['total_purchase']; ?></td>
    </tr>

    <?php } ?>

<?php } else { ?>

    <tr>
        <td colspan="3">No purchase found.</td>
    </tr>

<?php } ?>

</table>

<br>

<a href="index.php">Back to Customers</a>