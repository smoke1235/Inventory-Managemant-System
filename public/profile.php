<?php
require_once '../src/inc/session_check.php';

$usersManager = new UsersManager($params);
$user = $usersManager->getUser($_SESSION['id']);

$template = $twig->load('profile.html');
echo $template->render(['user' => $user, 'title' => 'My profile']);