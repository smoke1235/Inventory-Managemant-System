<?php
require_once '../src/inc/session_check.php';

require_once '../src/classes/SupplierManger.php';
$supplierManger = new SupplierManger;
$item = $supplierManger->getSupplier(0);
$item = $supplierManger->fillItem($item);
$item = $supplierManger->save($item);

header('Location: ../public/suppliers.php');
