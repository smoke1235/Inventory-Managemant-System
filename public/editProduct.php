<?php

require_once '../src/inc/session_check.php';

$id = $params->get("id");

$productManager = new ProductManger($params);
$product = $productManager->getItem($id);

$supplierManger = new SupplierManger;
$suppliers = $supplierManger->getSuppliers();


// Check session for previous save.
if( isset($_SESSION['previous_save']) &&
		  $_SESSION['previous_save']['id']   == $id)
{
	// Get producttypeet and errors.
	$product 	  = $_SESSION['previous_save']['item'];
	$errors 	  = $_SESSION['previous_save']['errors'];
}
else
	$errors		  = null;

// Unset the previous save.
unset($_SESSION['previous_save']);

$template = $twig->load('edit-product.html');
echo $template->render(['suppliers' => $suppliers, 'product' => $product, 'title' => 'Edit product', 'errors' => $errors]);
