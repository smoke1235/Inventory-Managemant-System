<?php
$sql = "SELECT * FROM customers";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
