<?php
require_once "../db.php";

$name=$_POST['name'];
$price=$_POST['price'];

$stmt=$conn->prepare (
    "INSERT INTO products(name,price)VALUES(?,?)"
);
$stmt->bind_param("sd",$name,$price);

if($stmt->execute()){
    header("Location:index.php");
    exit;
}else{
    echo "Error:".$stmt->error;
}
$stmt->close();
?>
