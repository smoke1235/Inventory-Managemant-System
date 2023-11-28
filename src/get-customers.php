<?php
require_once '../config/connect.php';

$id = $_REQUEST['id'];

$sql = 'SELECT * FROM customers WHERE id = ?';

$stmt= $con->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$stmt->bind_result(
    $customer_name,
    $customer_company,
    $customer_street,
    $customer_postal,
    $customer_city,
    $customer_country
);

$data=array();
while($stmt->fetch())$data[]=array(
    'customer-name'         =>  $customer_name,
    'customer-company'      =>  $customer_company,
    'customer-street'       =>  $customer_street,
    'customer-postalcode'   =>  $customer_postal,
    'customer-city'         =>  $customer_city,
    'customer-country'      =>  $customer_country
);

$stmt->free_result();
$stmt->close();

header('Content-Type: application/json');
exit(json_encode($data));
