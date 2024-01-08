<?php
session_start();

$username = "";
$email = "";

require_once '../config/connect.php';

if (isset($_POST['register'])) {
    $username = $_POST['$username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username)) {
        echo '<script>alert("Username is required");</script>';
    }

    if (empty($email)) {
        echo '<script>alert("email is required");</script>';
    }

    if (empty($password)) {
        echo '<script>alert("password is required");</script>';
    }

    $user_check = "SELECT
        *
    FROM
        `users`
    WHERE
        username = '$username' OR email = '$email'
    LIMIT 1";

    $result = mysqli_query($con, $user_check);
    $user = mysqli_fetch_assoc($result);

    if ($user['username'] === $username) {
        echo '<script>alert("Username already exists");</script>';
    }

    if ($user['email'] === $email) {
        echo '<script>alert("Email already exists");</script>';
    }

    if (count($errors) == 0) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users`(
        `username`,
        `password`,
        `email`,
        `created`
    )
    VALUES(
        '$username',
        '$hash',
        '$email',
        current_timestamp()
    )";
        mysqli_query($con, $sql);
        header('Location: ../index.php');
    }

}

?>
