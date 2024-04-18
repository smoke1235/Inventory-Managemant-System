<?php

require_once '../src/inc/session_check.php';

$template = $twig->load('insert-suppliers.html');
echo $template->render(['title' => 'New supplier']);
