<?php
session_start();

$username = "";
$email = "";
$errors = array();

require_once '../config/connect.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($con, $_POST['$username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
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

if (count($errors) == 0 ) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql  = "INSERT INTO `users`(
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
    $_SESSION['username'] = $username;
    header('Location: ../index.php');
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
    <div class="container">
        <div class="register-container">
            <h1>Inventory Manager</h1>
            <h2>Sign up</h2>
            <form action="register.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
                <label for="email">Email:</label>
                <input type="text" name="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <input type="submit" name="submit" value="Sign up">
            </form>
            <a href="../index.php">Already have an account?</a>
        </div>
    </div>
</body>

</html>
