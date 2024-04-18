<?php
require_once '../src/inc/session_check.php';

require_once '../src/classes/SupplierManger.php';

$id = $_POST['id'];
$supplierManger = new SupplierManger;
$item = $supplierManger->getSupplier($id);
$item = $supplierManger->fillItem($item);
$item = $supplierManger->save($item);

header('Location: ../public/suppliers.php');

