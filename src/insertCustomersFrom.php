<?php
require_once '../src/inc/session_check.php';

$id = $params->get("id");

$supplierManger = new CustomerManger;
$item = $supplierManger->getItem($id);
$item = $supplierManger->fillItem($item);
$item = $supplierManger->save($item);

header('Location: ../public/customers.php');
