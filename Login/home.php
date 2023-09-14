<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="main.css" rel="stylesheet">
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>Title</h1>
                <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
                <a href="logout.php"><i class="fa-sign-out-alt"></i>Logout</a>
            </div>
        </nav>
        <div class="content">
            <h2>Home Page</h2>
            <p>Welcome, <?=$_SESSION['name']?>!</p>
        </div>
    </body>
</html>