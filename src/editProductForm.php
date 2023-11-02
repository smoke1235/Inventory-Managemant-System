<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$newQuantity = $_POST['quantity'];
$id = $_POST['id'];
$product_descr = $_POST['product_description'];
$grabbed_price = $_POST['product_price'];
$product_price = (float) $grabbed_price;
$supplier_id = $_POST['supplier'];
$supplier = (int) $supplier_id;
$other_details = $_POST['other_details'];

$sql =
"UPDATE products
SET
product_description= '$product_descr',
product_quantity= $newQuantity,
product_price= $product_price,
other_details= '$other_details',
supplier_id= $supplier
WHERE id= $id";
if (mysqli_query($con, $sql)) {
    header('Location: ../public/products.php');
}
