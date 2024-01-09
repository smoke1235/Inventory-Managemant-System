<?php
require_once '../config/connect.php';


$stmt = $con->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param('s', $username);

$username = $_POST['username'];
$password = $_POST['password'];

$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    echo "JIPPIE";
} else {
    echo "Invalid login.";
}
