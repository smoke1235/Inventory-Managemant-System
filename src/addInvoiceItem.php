<?php
if (isset($_POST["id"])) {
    $passedId =  $_GET["id"];

    require_once '../config/connect.php';

    $sql = "SELECT * FROM products WHERE id = $passedId";
}
