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
$number_var = $_REQUEST['number'];
$number = (int) $number_var;
$email = $_REQUEST['email'];
$companyName = $_REQUEST['companyName'];
$customerStreet = $_REQUEST['customerStreet'];
$customerPostcode = $_REQUEST['customerPostcode'];
$customerCity = $_REQUEST['customerCity'];
$customerCountry = $_REQUEST['customerCountry'];

$sql =
"INSERT INTO customers
(first_name, last_name, number, email, company_name, street, postcode, city, country, date)
VALUES ('$firstName', '$lastName', $number, '$email', '$companyName', '$customerStreet',
'$customerPostcode', '$customerCity', '$customerCountry', current_timestamp())";
if (mysqli_query($con, $sql)) {
    header('Location: customers.php');
}
