<?php

require_once '../src/inc/session_check.php';

$id = $params->get("id");

$sup = new CustomerManger;
$customer = $sup->delete($id);

header('Location: ../public/customers.php');
exit;