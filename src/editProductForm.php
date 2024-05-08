<?php

require_once '../src/inc/session_check.php';

$id 			= (int) $params->get('id', 0);

$productManager = new ProductManger($params);

// Fetch product category object.
$product = $productManager->getItem($id);

// Fill product with data from the edit form.
$product = $productManager->fillProduct($product);


// Fetch an array with the result of saving it.
$success = $productManager->saveProduct($product);

if (Validator::isArray($success, false))
{
	$errors = $success;

	$_SESSION['previous_save'] = array();
	$_SESSION['previous_save']['id'] = $id;

	$_SESSION['previous_save']['item'] = $product;
	$_SESSION['previous_save']['errors'] = $errors;

	$url = '../public/editProduct.php';
	if ($id)
		$url .= '?id='.$id;
	
    header('Location: '.$url);
    exit; //die('error');
}

header('Location: ../public/products.php');

