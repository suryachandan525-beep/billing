<!DOCTYPE html>
<html>
    <head>
        <title>Add Products</title>
    </head>
 <body>
    <h2>Add Products</h2>
    <form action="store.php" method="POST">
        Product Name:
        <input type="text" name="name" required>
        <br><br>
        Price:
        <input type="number" name="price" step="0.01" min="0" required>
        <br><br>
        <button type="submit">Save Product</button>
</form>

</body>
</html>