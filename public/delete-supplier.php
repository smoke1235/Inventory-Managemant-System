<?php

require_once '../src/inc/session_check.php';

$id = $params->get("id");

$sup = new SupplierManger;
$customer = $sup->delete($id);

header('Location: ../public/suppliers.php');
exit;