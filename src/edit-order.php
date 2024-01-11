<?php
require_once '../config/connect.php';

$id =                   $_POST['hidden'];

$user =                 $_SESSION['id'];
$customer =             $_POST['customer_select'];
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

$sql1 = "UPDATE
    orders
SET
    `status` = '$status',
    `user_id` = '$user',
    `customer_id` = '$customer',
    `number` = '$number',
    `mail` = '$mail',
    `shipping_name` = '$shipping_name',
    `shipping_company` = '$shipping_company',
    `shipping_street` = '$shipping_street',
    `shipping_postalcode` = '$shipping_postalcode',
    `shipping_city` = '$shipping_city',
    `shipping_country` = '$shipping_country',
    `billing_name` = '$billing_name',
    `billing_company` = '$billing_company',
    `billing_street` = '$billing_street',
    `Billing_postalcode` = '$billing_postalcode',
    `billing_city` = '$billing_city',
    `billing_city` = '$billing_city',
    `billing_country` = '$billing_country',
    `updated` = CURRENT_TIMESTAMP()
WHERE
    id = $id";

$update = $con->query($sql1);

$delInvoiceLine = "DELETE FROM order_line where order_id = $id";
$update = $con->query($delInvoiceLine);

$total_products = count($_POST['product']);

for($i=0;$i<$total_products;$i++) {
    $product =      $_POST['product'][$i];
    $qty =          $_POST['qty'][$i];

    $sql2 = "INSERT INTO order_line(
        invoice_id,
        product_id,
        quantity
    )
    VALUES ($id, $product, $qty)";
    $sql3 = mysqli_query($con, $sql2);
    
    if(!$sql3) {
        $error = true;
        $error_msg = $error_msg.mysqli_error($con);
    }
}

if($sql2) {
    header('Location:../public/order.php');
}
