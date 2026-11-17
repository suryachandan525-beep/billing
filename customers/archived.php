<?php
require_once "../db.php";

$sql = "SELECT * FROM customers
        WHERE status = 'archived'
        ORDER BY id DESC";

$result = $conn->query($sql);
?>

<h2>Archived Customers</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Mobile</th>
    <th>Email</th>
    <th>Address</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['mobile']); ?></td>
    <td><?php echo htmlspecialchars($row['email']); ?></td>
    <td><?php echo htmlspecialchars($row['address']); ?></td>

    <td>
        <form action="restore.php" method="POST">
            <input type="hidden" name="id"
                   value="<?php echo $row['id']; ?>">

            <button type="submit">Restore</button>
        </form>
    </td>
</tr>

<?php } ?>

</table>

<a href="index.php">Back to Customers</a>