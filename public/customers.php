<?php

require_once '../src/inc/session_check.php';

$manager = new CustomerManger;
$customers = $manager->getList();
$template = $twig->load('customers.html');
echo $template->render(['customers' => $customers, 'title' => 'Customers']);
