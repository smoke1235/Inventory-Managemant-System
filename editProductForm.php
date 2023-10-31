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

$sql = "UPDATE products SET quantity= $newQuantity WHERE id= $id";
if (mysqli_query($con, $sql)) {
    header('Location: products.php');
}
