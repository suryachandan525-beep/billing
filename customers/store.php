<?php
require_once "../db.php";

$name=$_POST['name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$address=$_POST['address'];


$stmt=$conn->prepare(
    "INSERT INTO customers(name,mobile,email,address)
    Values(?,?,?,?)"
);

$stmt->bind_param("ssss",$name,$mobile,$email,$address);

if($stmt->execute()){
    header("Location:add.php");
    exit;
}else{
    echo "Error:".$stmt->error;
}
$stmt->close();
?>