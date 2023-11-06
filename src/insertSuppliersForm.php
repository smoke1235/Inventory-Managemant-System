<?php
require_once '../config/connect.php';

$supplierName = $_REQUEST['supplierName'];
$number = $_REQUEST['number'];
$email = $_REQUEST['email'];
$supplierStreet = $_REQUEST['supplierStreet'];
$supplierPostcode = $_REQUEST['supplierPostcode'];
$supplierCity = $_REQUEST['supplierCity'];
$supplierCountry = $_REQUEST['supplierCountry'];

$sql = "INSERT INTO suppliers (name, number, email, street, postcode, city, country)
VALUES
('$supplierName', '$number', '$email', '$supplierStreet', '$supplierPostcode', '$supplierCity', '$supplierCountry')";
if (mysqli_query($con, $sql)) {
    header('Location: ../public/suppliers.php');
}
