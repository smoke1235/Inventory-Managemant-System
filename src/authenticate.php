<?php
require_once '../config/connect.php';

$stmt = $con->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param('s', $_POST['username']);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();
print_r($user); echo "<br>";
if ($user && password_verify($_POST['password'], $user['password'])) {
    echo "JIPPIE";
} else {
    echo "Invalid username or password.";
}
