<?php
require_once '../config/connect.php';

if (isset($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed = password_hash('$password', PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql_u = "SELECT * FROM users WHERE username='$username'";
    $sql_e = "SELECT * FROM users WHERE email='$email'";
    $result_u = mysqli_query($con, $sql_u);
    $result_e = mysqli_query($con, $sql_e);

    $query = "INSERT INTO `users`(
                `username`,
                `password`,
                `email`,
                `created`
            )
            VALUES(
                '$username',
                '$hashed',
                '$email',
                current_timestamp()
            )";
    $result = mysqli_query($con, $query);

    if ($result){
        header('Location: ../index.php');
    }
}
