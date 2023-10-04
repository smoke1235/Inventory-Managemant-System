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
$newFirstName = $_post['newFirstName'];
$newLastName = $_post['newLastName'];
$newCompanyName = $_post['newCompanyName'];
$newStreet = $_post['newStreet'];
$newPostcode = $_post['newPostcode'];
$newCity = $_post['newCity'];
$newCountry = $_post['newCountry'];

$sql = "UPDATE customers SET
first_name='$newFirstName', last_name='$newLastName', company_name='$newCompanyName', street='$newStreet',
postcode='$newPostcode', city='$newCity', country='$newCountry' WHERE id=$id";
if (mysqli_query($con, $sql)) {
    header('Location: customers.php');
} else {
    echo "ERROR customer information not updated";
}

?>