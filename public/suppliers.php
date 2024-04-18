<?php
require_once '../src/inc/session_check.php';
require_once '../src/classes/SupplierManger.php';

$sup = new SupplierManger;
$suppliers = $sup->getSuppliers();
$template = $twig->load('suppliers.html');
echo $template->render(['suppliers' => $suppliers, 'title' => 'Suppliers']);



