<?php

require_once '../src/inc/session_check.php';

$id = $params->get("id");

$sup = new CustomerManger;
$customer = $sup->getItem($id);

if ($customer->id == 0) {
	$title = 'New customer';
}
else {
	$title = 'Edit customer';
}

$template = $twig->load('edit-customer.html');
echo $template->render(['customer' => $customer, 'title' => 'Edit customer']);

