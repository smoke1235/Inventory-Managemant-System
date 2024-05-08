<?php
require_once '../src/inc/session_check.php';

$orderManger = new OrderManger($params);
$orders = $orderManger->getList();

$template = $twig->load('orders.html');
echo $template->render(['orders' => $orders, 'title' => 'Orders']);
