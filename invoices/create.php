<?php 
require_once "../db.php";
$customers=$conn->query("SELECT * FROM customers");
$products=$conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Invoice</title>
</head>
<body>
    <h2>Create Invoice</h2>
    <form action="store.php" method="POST">
        <label>Select Customer:</label>
        <select name="customer_id"required>
            <option value="">Choose Customer</option>

            <?php while ($row=$customers->fetch_assoc()){ ?>
            <option value="<?php echo $row['id'];?>">
                <?php echo htmlspecialchars($row['name']);?>
            </option>
             <?php } ?>
</select>

<br><br>
<div id="products">
    <div class="product-row">
<label>Select Product:</label>
<select name="product_id[]" required>
    <option value="">Choose Product</option>

    <?php 
    $products->data_seek(0);
    while ($row=$products->fetch_assoc()){?>
    <option value="<?php echo $row['id'];?>">
        <?php echo htmlspecialchars($row['name']);?>
        - ₹<?php echo htmlspecialchars($row['price']); ?>
     </option>
    <?php } ?>
</select>

<br><br>
<label>Quantity:</label>
<input type="number" name="quantity[]" min="1" value="1" required>
<button type="button" onclick="removeProduct(this)">Remove</button>
<br><br>
</div>
</div>
<button type="button" onclick="addProduct()">+ Add Another Product</button>
<br><br>

<button type="submit">Create Invoices</button>
</form>

<script>
function addProduct() {
    let container = document.getElementById("products");
    let firstRow = container.querySelector(".product-row");
    let newRow = firstRow.cloneNode(true);

    newRow.querySelector("select").selectedIndex = 0;
    newRow.querySelector("input").value = 1;

    container.appendChild(newRow);
}

function removeProduct(button) {
    let rows = document.querySelectorAll(".product-row");

    if (rows.length > 1) {
        button.closest(".product-row").remove();
    } else {
        alert("Kam se kam ek product zaroori hai.");
    }
}
</script>

</body>
</html>