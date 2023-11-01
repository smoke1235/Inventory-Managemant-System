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
$supplierCountry = $_POST['newSupplierCountry'];
$email = $_POST['email'];
$number = $_POST['number'];
$city = $_POST['city'];

$sql =
"UPDATE suppliers
SET
name= '$supplierName',
number= '$number',
email= '$email',
street= '$supplierStreet',
postcode= '$supplierPostcode',
city= '$city',
country= '$supplierCountry'
WHERE id= $id";
if (mysqli_query($con, $sql)) {
    header('Location: suppliers.php');
}
