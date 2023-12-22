<?php
require_once '../config/connect.php';
session_start();
if (isset($_SESSION['username'])) {
    header('location:register.php');
}

if (isset($_POST['register'])) {
    if(empty($_POST['username'] && $_POST['email'] && $_POST['password'])) {
        echo '<script>alert("All Fields are required")</script>';
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);

        $sql = "INSERT INTO users (
            username,
            password,
            email,
            created
        )
        VALUES (
        '$username',
        '$password',
        '$email',
        current_timestamp()
        )";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager | Register</title>
    <link rel="stylesheet" href="../assets/CSS/register.css">
    <meta name="description" name="">
</head>
<body>
    <h1>Drukkerij Teeuwen Inventory Manager</h1>
    <div class="container">
        <div class="register-container">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <label for="username">User name:</label>
                <input type="text" name="username" required>
                <label for="email">Email:</label>
                <input type="text" name="email" placeholder="" required>
                <label for="password">Password:</label>
                <input type="text" name="password" required>
                <input type="submit" name="submit" value="Sign up">
            </form>
        </div>
    </div>
</body>
</html>
