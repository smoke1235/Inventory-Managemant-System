<?php
require_once '../config/connect.php';

$product_name = $_REQUEST['product_name'];
$product_descr = $_REQUEST['product_descr'];
$string_quantity = $_REQUEST['quantity'];
$quantity = (int) $string_quantity;
$string_price = $_REQUEST['product_price'];
$product_price = (float) $string_price;
$min_stock = $_REQUEST['min_stock'];
$other_details = $_REQUEST['other_details'];
$string_id = $_REQUEST['supplier_id'];
$supplier_id = (int) $string_id;

$sql =
"INSERT INTO products
(product_name, product_description, product_quantity, product_price, min_stock, other_details, supplier_id, date)
VALUES ('$product_name', '$product_descr', '$quantity', '$product_price', '$min_stock', '$other_details', '$supplier_id',
current_timestamp())";
if (mysqli_query($con, $sql)) {
    header('Location: ../public/products.php');
}
