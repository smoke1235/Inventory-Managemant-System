<?php

require_once '../config/connect.php';

$user =                 $_SESSION['id'];
$number =               $_POST['customer_number'];
$mail =                 $_POST['customer_email'];
$status =               $_POST['invoice_status'];

$shipping_name =        $_POST['shipping_name'];
$shipping_company =     $_POST['shipping_company'];
$shipping_street =      $_POST['shipping_street'];
$shipping_postalcode =  $_POST['shipping_postalcode'];
$shipping_city =        $_POST['shipping_city'];
$shipping_country =     $_POST['shipping_country'];
$billing_name =         $_POST['billing_name'];
$billing_company =      $_POST['billing_company'];
$billing_street =       $_POST['billing_street'];
$billing_postalcode =   $_POST['billing_postalcode'];
$billing_city =         $_POST['billing_city'];
$billing_country =      $_POST['billing_country'];

$sql1 = "INSERT INTO invoices
(status, user_id, number, mail,
shipping_name, shipping_company, shipping_street, shipping_postalcode, shipping_city, shipping_country,
billing_name, billing_company, billing_street, billing_postalcode, billing_city, billing_country,
updated, created)
VALUES
('$status', '$user', '$number', '$mail',
'$shipping_name', '$shipping_company', '$shipping_street', '$shipping_postalcode', '$shipping_city', '$shipping_country'
,'$billing_name', '$billing_company', '$billing_street', '$billing_postalcode', '$billing_city', '$billing_country',
current_timestamp(), current_timestamp())";

if ($con->query($sql1) === true) {
    $last_id = $con->insert_id;
} else {
    echo mysqli_error($con);
}

$total_products =       count($_POST['product']);
$total_qty =            count($_POST['qty']);


for($i=0;$i<$total_products;$i++) {
    $product =      $_POST['product'][$i];
    $qty =          $_POST['qty'][$i];

    $sql2 = "INSERT INTO invoice_line
    (invoice_id, product_id, quantity)
    VALUES ($last_id, $product, $qty)";
    echo $sql2;
    $sql3 = mysqli_query($con, $sql2);
    

    if(!$sql3) {
        $error = true;
        $error_msg = $error_msg.mysqli_error($con);
    }
}

if($sql3) {
    header('location: ../public/invoice.php');
}
