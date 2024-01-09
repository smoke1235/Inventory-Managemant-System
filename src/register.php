<?php
require_once '../config/connect.php';

if (isset($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    $hashed = password_hash('$password', PASSWORD_BCRYPT);
    
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
