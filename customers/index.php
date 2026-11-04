<?php
require_once "../db.php";
$sql="SELECT * FROM customers";
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
    <br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Address</th>
            <th>Edit</th>
        </tr>

        <?Php while($row=$result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['mobile'] ??'')?></td>
            <td><?php echo htmlspecialchars($row['email']??'');?></td>
            <td><?Php echo htmlspecialchars($row['address']??'')?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id'];?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>"
   onclick="return confirm('Are you sure you want to delete this customer?')">
   Delete
</a>
        </td>
        </tr>
        <?php } ?>
</table>
</body>
</html>    
