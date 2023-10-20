<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$product_name = $_REQUEST['product_name'];
$product_descr = $_REQUEST['product_descr'];
$string_quantity = $_REQUEST['quantity'];
$quantity = (int) $string_quantity;
$string_price = $_REQUEST['product_price'];
$product_price = (float) $string_price;
$other_details = $_REQUEST['other_details'];
$string_id = $_REQUEST['supplier_id'];
$supplier_id = (int) $string_id;

$sql =
    "INSERT INTO products
(product_name, product_description, product_quantity, product_price, other_details, supplier_id, date)
VALUES ('$product_name', '$product_descr', '$quantity', '$product_price', '$other_details', '$supplier_id',
current_timestamp())";
if (mysqli_query($con, $sql)) {
    header('Location: products.php');
}
