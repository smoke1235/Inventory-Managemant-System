<?php
$username = "";
$password = "";
$email = "";
$errMsg = "";

require '/../config/connect.php';

if (strtoupper($_SERVER['REQUEST_METHODE']) == 'POST') {

    if (!empty($_POST['username'])) {
        $errMsg = "Please fill in your username.";
        echo '<script> alert("' . $errMsg . '"); </script>';
    } else {
        $username = $_POST['username'];
    }

    if (!empty($_POST['password'])) {
        $errMsg = "Please fill in your password.";
        echo '<script> alert("' . $errMsg . '"); </script>';
    } else {
        $password = $_POST['password'];
    }

    if (!empty($_POST['email'])) {
        $errMsg = "Please fill in your email.";
        echo '<script> alert("' . $errMsg . '"); </script>';
    } else {
        $email = $_POST['email'];
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

        if (!preg_match($pattern, $email)) {
            $errMsg = "Email invalid.";
            echo '<script> alert("' . $errMsg . '"); </script>';
        }
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
    <meta name="description" content="">
</head>

<body>
    <div class="container">
        <div class="register-container">
            <h1>Inventory Manager</h1>
            <h2>Register</h2>
            <form method="POST" autocomplete="off">
                <label for="username">Username:</label>
                <input type="text" name="username" maxlength="50" required>
                <label for="email">Email:</label>
                <input type="text" name="email" maxlength="80" required>
                <label for="password">Password:</label>
                <input type="password" name="password" maxlength="90" required>
                <input type="submit" name="submit" value="Sign up">
            </form>
            <a href="../index.php">Already have an account?</a>
        </div>
    </div>
</body>

</html>
