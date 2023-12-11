<?php
if (isset($_POST["id"])) {
    $passedId = $_POST["id"];

    require_once '../config/connect.php';

    $sql = "SELECT * FROM products WHERE id = $passedId";

    $result =array();
    while ($row = mysqli_fetch_array($sql)) {
        $result[] = array(
            'id'        => $row['id'],
            'name'      => $row['product_name'],
            'descr'     => $row['$product_description'],
            'qty'       => $row['product_quantity'],
            'price'     => $row['product_price'],
        );
    }
}

$json = json_encode($result);
