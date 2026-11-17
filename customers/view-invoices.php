<?php 
require_once "../db.php";
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location:index.php");
    exit;
}
$customer_id=(int)$_GET['id'];
$stmt=$conn->prepare("SELECT id, invoice_date,subtotal
        FROM invoices WHERE customer_id=?
        ORDER BY id DESC");
$stmt->bind_param("i",$customer_id);
$stmt->execute();
$result=$stmt->get_result();
?>

<h2>Customer Invoice History</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Invoice ID</th>
        <th>Invoice Date</th>
        <th>Total Amount</th>
    </tr>
<?php while($row=$result->fetch_assoc()){?>
     <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['invoice_date'];?></td>
        <td><?php echo $row['subtotal'];?></td>
     </tr>
       <?php } ?>
</table>

<br>
<a href="index.php">Back to Customers</a>
