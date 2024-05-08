<?php
require_once '../src/inc/session_check.php';

$id = $params->get("id");

$orderManger = new OrderManger($params);
$order = $orderManger->getOrder($id);
$order->setItems($orderManger->getOrderLines($order->id));

$customerManger = new CustomerManger;
$customers = $customerManger->getList();

$orderStatusLang = array(
    0 => "NEW",
    1 => 'IN PROCESS',
    2 => 'SHIPPING',
    3 => 'DELIVERD',
    4 => 'CLOSED',
    5 => 'RETURNED',
    6 => "ARCHIEVED",
);

$title = "Edit order";

$template = $twig->load('edit-order.html');
echo $template->render(['order' => $order, 'title' => $title, 'customers' => $customers, 'orderStatusOptions' => $orderStatusLang]);
