<?php
require_once '../config/connect.php';

$stmt = $con->prepare("SELECT product_name, name
FROM products INNER JOIN suppliers ON products.supplier_id=suppliers.id
WHERE (products.product_name LIKE '$search%' OR name LIKE '$search%')");
$stmt->execute()
