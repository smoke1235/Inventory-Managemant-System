<?php
require_once '../config/connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $con->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows() > 0) {
    $stmt->bind_result($id, $username, $hashed);
    $stmt->fetch();

    if (password_verify($password, $hashed)) {
        
    } else {
        echo "Invalid username or password.";
    }
}
