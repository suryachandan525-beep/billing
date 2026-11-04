<?php 
require_once "../db.php";
$id=$_GET['id'];
$sql="DELETE FROM products WHERE id=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("i",$id);
if($stmt->execute()){
    header("Location:index.php");
    exit;
}else{
    echo "Error:".$stmt->error;

}
$stmt->close();
$conn->close();
?>