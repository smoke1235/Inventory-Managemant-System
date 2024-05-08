<?php

require_once '../src/inc/session_check.php';

$id = $params->get("id");

$productManager = new ProductManger($params);
$customer = $productManager->delete($id);

header('Location: ../public/products.php');
exit;