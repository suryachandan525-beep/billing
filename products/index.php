<?php 
require_once "../db.php";
$sql="SELECT * FROM products";
$result=$conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Products</title>
</head>
<body>
    <h2>Add Products</h2>
    <a href="add.php">Add New Products</a>
    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
       <?php 
       while($row=$result->fetch_assoc()){ 
        ?>
        <tr>
            <td><?php echo $row ['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']);?></td>
            <td><?php echo htmlspecialchars($row['price']);?></td>
                      <td>
                <a href="edit.php?id=<?php echo $row['id'];?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>"
   onclick="return confirm('Are you sure you want to delete this Product?')">
   Delete
</a>
        </td>
        </tr>
      <?php } ?> 

</table>
</body>
</html>
