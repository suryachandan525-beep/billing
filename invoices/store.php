<?php
require_once "../db.php";

$customer_id=$_POST['customer_id'];
$product_ids=$_POST['product_id'];
$quantities=$_POST['quantity'];

$invoice_date=date("Y-m-d");
$subtotal=0;
$items=[];

foreach($product_ids as $key=>$product_id){

    $product_id=(int)$product_id;
    $quantity=(int)$quantities[$key];

    if($product_id<1 || $quantity<1){
        die("Invalid product or quantity");
    }

    $stmt=$conn->prepare("SELECT name,price FROM products WHERE id=?");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();

    $result=$stmt->get_result();
    $product=$result->fetch_assoc();
    $stmt->close();

    if(!$product){
        die("Product not found");
    }

    $product_name=$product['name'];
    $price=(float)$product['price'];
    $total=$price*$quantity;

    $subtotal+=$total;

    $items[]=[
        'product_id'=>$product_id,
        'product_name'=>$product_name,
        'price'=>$price,
        'quantity'=>$quantity,
        'total'=>$total
    ];
}

$stmt=$conn->prepare(
    "INSERT INTO invoices (customer_id,invoice_date,subtotal)
    VALUES(?,?,?)"
);

$stmt->bind_param("isd",$customer_id,$invoice_date,$subtotal);

if(!$stmt->execute()){
    die("Invoice save error:".$stmt->error);
}

$invoice_id=$conn->insert_id;
$stmt->close();

$stmt=$conn->prepare(
    "INSERT INTO invoice_items
    (invoice_id,product_id,product_name,price,quantity,total)
    VALUES(?,?,?,?,?,?)"
);

foreach($items as $item){

    $product_id=$item['product_id'];
    $product_name=$item['product_name'];
    $price=$item['price'];
    $quantity=$item['quantity'];
    $total=$item['total'];

    $stmt->bind_param(
        "iisdid",
        $invoice_id,
        $product_id,
        $product_name,
        $price,
        $quantity,
        $total
    );

    if(!$stmt->execute()){
        die("Item save error:".$stmt->error);
    }
}

$stmt->close();
$conn->close();

header("Location:index.php");
exit;
?>