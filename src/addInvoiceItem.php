<?php
if (isset($_POST["id"])) {
    $passedId = $_POST["id"];

    require_once '../config/connect.php';

    $sql = "SELECT * FROM products WHERE id = $passedId";
    
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(array());
    }

    $con->close();
}
