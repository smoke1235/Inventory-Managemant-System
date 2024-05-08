<?php
// Products
require_once '../src/inc/session_check.php';

$productManager = new ProductManger($params);
$products = $productManager->getProductList("id", "DESC");

$template = $twig->load('products.html');
echo $template->render(['products' => $products, 'title' => 'Products']);
