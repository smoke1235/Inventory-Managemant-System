<?php
$username = "";
$password = "";

require_once '../config/connect.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql_u = "SELECT * FROM users WHERE username='$username'";
    $sql_e = "SELECT * FROM users WHERE email='$email'";
    $result_u = mysqli_query($con, $sql_u);
    $result_e = mysqli_query($con, $sql_e);
    
    if (mysqli_num_rows($result_u) > 0) {
        echo '<script> alert("Username already taken.")</script>';
    } elseif (mysqli_num_rows($result_e > 0)) {
        echo '<script> alert("Email already in use.")</script>';
    } else {
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
        echo $query;
    }
}
