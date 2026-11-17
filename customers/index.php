<?php
require_once "../db.php";
$sql="SELECT customers.*,
     COALESCE(SUM(invoices.subtotal),0)AS total_purchase,
     COUNT(invoices.id)AS total_invoice FROM customers
     LEFT JOIN invoices ON customers.id=invoices.customer_id
     WHERE customers.status='active'
     GROUP BY customers.id ORDER BY customers.id DESC";
$result=$conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
</head>
<body>
    <h2>Customer List</h2>
    <a href="add.php">Add New Customer</a>
    <a href="archived.php">Archived Customers</a>
    <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>Total purchase</th>
            <th>Total Invoice</th>
            <th>Action</th>
        </tr>

        <?Php while($row=$result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['mobile'] ??'')?></td>
            <td><?php echo htmlspecialchars($row['email']??'');?></td>
            <td><?Php echo htmlspecialchars($row['address']??'')?></td>
            <td><?php echo $row['total_purchase'];?></td>
            <td><?php echo $row['total_invoice'];?></td>    
            <td>
                <a href="edit.php?id=<?php echo $row['id'];?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>"
   onclick="return confirm('Are you sure you want to delete this customer?')">
   Delete</a>
   <a href="view-invoices.php?id=<?php echo $row['id']; ?>">
    View Invoice</a>
    <a href="grouped-items.php?id=<?php echo $row['id']; ?>">
    Grouped Item List</a>

    <form action="archive.php" method="POST">
    <input type="hidden" name="id"
           value="<?php echo $row['id']; ?>">

    <button type="submit"
        onclick="return confirm('Are you sure you want to archive this customer?')">
        Archive
    </button>
</form>
        </td>
        </tr>
        <?php } ?>
</table>
</body>
</html>    
