<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$companyName = $_REQUEST['companyName'];
$customerStreet = $_REQUEST['customerStreet'];
$customerPostcode = $_REQUEST['customerPostcode'];
$customerCity = $_REQUEST['customerCity'];
$customerCountry = $_REQUEST['customerCountry'];

$sql = "INSERT INTO customers (first_name, last_name, company_name, street, postcode, city, country)
VALUES ('$firstName', '$lastName', '$companyName', '$customerStreet',
'$customerPostcode', '$customerCity', '$customerCountry')";
if (mysqli_query($con, $sql)) {
    header('Location: customers.php');
} else {
    echo "ERROR! Customer not added to system";
}

$con->close()
?>