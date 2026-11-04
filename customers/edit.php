<?php
require_once "../db.php";
$id=$_GET['id'];
$sql="SELECT * FROM customers WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>

<h2>Edit Customer</h2>

<form action="update.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
     Name:
    <input type="text" name="name"
           value="<?php echo htmlspecialchars($row['name']); ?>" required>
    <br><br>

    Mobile:
    <input type="text" name="mobile"
           value="<?php echo htmlspecialchars($row['mobile'] ?? ''); ?>">
    <br><br>

    Email:
    <input type="email" name="email"
           value="<?php echo htmlspecialchars($row['email'] ?? ''); ?>">
    <br><br>

    Address:
    <textarea name="address"><?php echo htmlspecialchars($row['address'] ?? ''); ?></textarea>
    <br><br>

    <button type="submit">Update Customer</button>

</form>
</body>
</html>