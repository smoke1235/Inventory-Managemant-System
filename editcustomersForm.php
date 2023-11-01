<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$id = $_POST['id'];
$newFirstName = $_POST['newFirstName'];
$newLastName = $_POST['newLastName'];
$newCompanyName = $_POST['newCompanyName'];
$newStreet = $_POST['newStreet'];
$newPostcode = $_POST['newPostcode'];
$newCity = $_POST['newCity'];
$newCountry = $_POST['newCountry'];
$number = $_POST['number'];
$email = $_POST['email'];

$sql =
"UPDATE
customers
SET
first_name='$newFirstName',
last_name='$newLastName',
number= '$number',
email= '$email',
company_name='$newCompanyName',
street='$newStreet',
postcode='$newPostcode',
city='$newCity',
country='$newCountry'
WHERE
id=$id";
if (mysqli_query($con, $sql)) {
    header('Location: customers.php');
}
