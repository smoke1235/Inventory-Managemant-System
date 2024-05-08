<?php

require_once '../src/inc/session_check.php';

$id = $params->get("hidden");

$orderManger = new OrderManger($params);
$order = $orderManger->getOrder($id);
$order = $orderManger->fillOrder($order);

$success = $orderManger->saveOrder($order);

header('Location:../public/order.php');
