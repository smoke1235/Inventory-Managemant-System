<?php
require_once '../config/connect.php';

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
"UPDATE customers
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
WHERE id=$id";
if (mysqli_query($con, $sql)) {
    header('Location: ../public/customers.php');
}
