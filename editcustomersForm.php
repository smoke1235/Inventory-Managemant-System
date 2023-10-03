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
$firstName = $_post['newFirstName'];
$lastName = $_post['newLastName'];
$companyName = $_post['newCompanyName'];
$street = $_post['newStreet'];
$postcode = $_post['newPostcode'];
$city = $_post['newCity'];
$country = $_post['newCountry'];

$sql = "UPDATE customers SET
firts_name='$firstName', last_name='$lastName', company_name='$companyName', street='$street',
postcode='$postcode', city='$city', country='$country'
WHERE id=$id";
echo $sql;
if (mysqli_query($con, $sql)) {
    header('Location: customers.php');
} else {
    echo "ERROR customer information not updated";
}

?>