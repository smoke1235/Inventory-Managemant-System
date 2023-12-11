<?php
require_once '../config/connect.php';

$id = $_GET['selectedValue'];

$sql = "SELECT * FROM customers WHERE id = $id";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(array());
}

$con->close();

