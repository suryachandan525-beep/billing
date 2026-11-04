<?php
require_once "../db.php";
$id=$_GET['id'];
$sql="SELECT * FROM products WHERE id=?";

$stmt=$conn->prepare($sql);
$stmt->bind_param("i",$id);

$stmt->execute();

$result=$stmt->get_result();
$row=$result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Products</title>
</head>
<body>
    <h2>Edit Products</h2>
    <form action="update.php" method="POST">

     <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
     Name:
    <input type="text" name="name"
           value="<?php echo htmlspecialchars($row['name']); ?>" required>
    <br><br>

    Price:
    <input type="number" name="price" step="0.01" min="0"
           value="<?php echo htmlspecialchars($row['price'] ); ?>"required>
           
    <br><br>

    <button type="submit">Update Product</button>
</form>
</body>
</html>
