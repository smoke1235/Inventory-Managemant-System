<?php
$quary = "SELECT id, name FROM suppliers";
$result = $con->query($quary);
if ($result->num_rows > 0) {
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
