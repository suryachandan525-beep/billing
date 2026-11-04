<?php
require_once "../db.php";
$id=$_POST['id'];
$name=$_POST['name'];
$price=$_POST['price'];

$sql="UPDATE products SET name= ?,price= ? WHERE id = ?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("sdi",$name,$price,$id);

if($stmt->execute()){
    header("Location:index.php");
    exit;

}else{
    echo"Error:" .$stmt->error;
}
$stmt->close();
$conn->close();
?>