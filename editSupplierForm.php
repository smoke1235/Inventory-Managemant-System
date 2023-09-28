<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$id = $_POST['id'];
$supplierName = $_POST['newSupplierName'];
$supplierStreet = $_POST['newSupplierStreet'];
$supplierPostcode = $_POST['newSuplierPostcode'];
$supplierCity = $_POST['newSuplierCity'];
$supplierCountry = $_POST['newSupplierCountry'];

$sql = "UPDATE suppliers SET
name= $supplierName, street= $supplierStreet,  postcode= $supplierPostcode,
city= $supplierCity, country= $supplierCountry WHERE id= $id";
echo $sql;
if (mysqli_query($con, $sql)) {
    header('Location: products.php');
} else {
    echo "ERROR Product not added";
}

$con->close();