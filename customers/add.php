<?php
require_once "../db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Customers</title>
</head>
<body>
    <h2>Add Customers</h2>
    <form action="store.php" method="POST">
        name:
        <input type="text" name="name"required>
        <br><br>

        mobile:
        <input type="text" name="mobile">
        <br><br>

        email:
        <input type="text" name="email">
        <br><br>

        address:
        <textarea name="address"></textarea>
        <br><br>

        <button type="submit">Save Customer</button>
    </form>

</body>
</html>
