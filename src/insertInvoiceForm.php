<?php
require_once '../config/connect.php';

$customer =             $_POST['customer_select'];
$number =               $_POST['customer_number'];
$mail =                 $_POST['customer_mail'];

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

$status =               $_POST['invoice_status'];

$item1 = "";
$item2 = "";

$sql1 = "";
$sql2 = "";
if (mysqli_query($con, $sql1, $sql2)) {
    echo "<script>alert('There are no fields to generate a report');document.location='admin/ahm/panel'</script>";
}
