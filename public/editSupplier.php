<?php
require_once '../src/inc/session_check.php';
require_once '../src/classes/SupplierManger.php';

$id = $_GET['id'];

$sup = new SupplierManger;
$supplier = $sup->getSupplier($id);


$template = $twig->load('edit-supplier.html');
echo $template->render(['supplier' => $supplier, 'title' => 'Edit supplier']);
