<?php
session_start();

require_once '../config/connect.php';

$stmt = $con->prepare('SELECT * FROM users WHERE username = ?');
$stmt->bind_param('s', $_POST['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($_POST['password'], $user['password'])) {
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['username'];
    header('Location: ../public/dashboard.php');
    exit;
} else {
    echo "Invalid password.";
}

$stmt->close();
