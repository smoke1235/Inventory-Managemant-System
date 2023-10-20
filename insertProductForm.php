<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$product_name = $_POST['product_name'];
$product_desc = $_POST['product_descr'];
$string = $_POST['quantity'];
$quantity = (float) $string;
$product_price = $_POST['product_price'];
$other_details = $_POST['other_details'];
$supplier_id = $_POST['supplier_id'];


$sql =
    "INSERT INTO products
(product_name, product_description, product_quantity, product_price, other_details, supplier_id, date)
VALUES ('$productName', '$product_descr', '$quantity', '$product_price', '$other_details', '$supplier_id',
current_timestamp())";
if (mysqli_query($con, $sql)) {
    header('Location: products.php');
}
