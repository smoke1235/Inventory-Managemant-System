<?php
require_once '../src/inc/session_check.php';

$supplierManger = new SupplierManger;
$item = $supplierManger->getSupplier(0);
$item = $supplierManger->fillItem($item);
$item = $supplierManger->save($item);

header('Location: ../public/suppliers.php');
