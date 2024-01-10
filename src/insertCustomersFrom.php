<?php
require_once '../config/connect.php';

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
"INSERT INTO customers(
    first_name,
    last_name,
    company_name,
    number,
    email,
    street,
    postcode,
    city,
    country,
)
VALUES (
    '$firstName',
    '$lastName',
    '$number',
    '$email',
    '$companyName',
    '$customerStreet',
    '$customerPostcode',
    '$customerCity',
    '$customerCountry'";
echo $sql;
if (mysqli_query($con, $sql)) {
    header('Location: ../public/customers.php');
}
