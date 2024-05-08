<?php
require_once '../src/inc/session_check.php';

$id = $params->get("id");

$sup = new SupplierManger;
$supplier = $sup->getSupplier($id);

if ($supplier->id == 0) {
	$title = 'New supplier';
}
else {
	$title = 'Edit supplier';
}

$template = $twig->load('edit-supplier.html');
echo $template->render(['supplier' => $supplier, 'title' => $title]);
