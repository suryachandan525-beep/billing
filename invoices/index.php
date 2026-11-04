<?php
require_once "../db.php";

$sql = "SELECT invoices.*, customers.name,
invoice_items.product_id, invoice_items.product_name,
invoice_items.price, invoice_items.quantity, invoice_items.total
FROM invoices
JOIN customers ON invoices.customer_id = customers.id
JOIN invoice_items ON invoices.id = invoice_items.invoice_id
ORDER BY invoices.id DESC";

$result = $conn->query($sql);

$invoices = [];

while ($row = $result->fetch_assoc()) {
    $invoices[$row['id']]['name'] = $row['name'];
    $invoices[$row['id']]['date'] = $row['invoice_date'];
    $invoices[$row['id']]['subtotal'] = $row['subtotal'];
    $invoices[$row['id']]['items'][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice List</title>
</head>
<body>

<h2>Invoice List</h2>
<a href="create.php">Create New Invoice</a>

<?php foreach ($invoices as $id => $invoice) { ?>

    <hr>

    <h3>Invoice #<?php echo $id; ?></h3>

    <p>
        <strong>Customer:</strong>
        <?php echo htmlspecialchars($invoice['name']); ?>
    </p>

    <p>
        <strong>Date:</strong>
        <?php echo $invoice['date']; ?>
    </p>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>

        <?php foreach ($invoice['items'] as $item) { ?>
            <tr>
                <td><?php echo $item['product_id']; ?></td>

                <td>
                    <?php echo htmlspecialchars($item['product_name']); ?>
                </td>

                <td>
                    ₹<?php echo number_format($item['price'], 2); ?>
                </td>

                <td><?php echo $item['quantity']; ?></td>

                <td>
                    ₹<?php echo number_format($item['total'], 2); ?>
                </td>
            </tr>
        <?php } ?>

        <tr>
            <td colspan="4" style="text-align:right;">
                <strong>Subtotal:</strong>
            </td>

            <td>
                <strong>
                    ₹<?php echo number_format($invoice['subtotal'], 2); ?>
                </strong>
            </td>
        </tr>
    </table>

<?php } ?>

</body>
</html>
