<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$productName = $_REQUEST['productName'];
$quantity = $_REQUEST['quantity'];
$int = (int)$quantity;

$sql = "INSERT INTO products (productName, quantity) VALUES ('$productName', '$int')";
if (mysqli_query($con, $sql)) {
    header('Location: products.php');
} else {
    echo "ERROR Product not added";
}

$con->close();
?>