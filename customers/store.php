<?php
session_start();
require_once "../db.php";

$name=trim($_POST['name'] ?? '');
$mobile=trim($_POST['mobile'] ?? '');
$email=trim($_POST['email'] ?? '');
$address=trim($_POST['address'] ?? '');

$_SESSION['old']=[
     'name' => $name,
    'mobile' => $mobile,
    'email' => $email,
    'address' => $address
];

if(empty($name)){
    $_SESSION['error'] = "Name is required";
    header("Location: add.php");
    exit;
}

if(!preg_match("/^[a-zA-Z ]+$/",$name)){
    $_SESSION['error']="Name must contain only letters";
    header("Location:add.php");
    exit;
}
if(!empty($mobile)&& !preg_match("/^[6-9][0-9]{9}$/",$mobile)){
    $_SESSION['error']="Enter valid mobile number";
    header("Location:add.php");
    exit;
}
 
if(!empty($email)&& !filter_var($email,FILTER_VALIDATE_EMAIL)){
    $_SESSION['error']="Enter a valid email address";
    header("Location:add.php");
    exit;
}

$stmt=$conn->prepare(
    "INSERT INTO customers(name,mobile,email,address)
    Values(?,?,?,?)"
);

$stmt->bind_param("ssss",$name,$mobile,$email,$address);

if($stmt->execute()){
    unset($_SESSION['old']);
    $_SESSION['success']="Customer added successfully";
    header("Location:add.php");
    exit;
}else{
    $_SESSION['error']="something went wrong";
    header("Location:add.php");
    exit;
}
$stmt->close();
?>