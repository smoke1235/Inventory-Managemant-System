<?php
require '../config/connect.php';

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
    header('Location: ../public/suppliers.php');
}
