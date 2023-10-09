<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if ( !isset($_SESSION['loggedin']) ) {
    header('Location: index.html');
    exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventoryManager';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT password, email FROM users WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Profile Page</title>
        <meta name="discription" content="">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="Assets/SCSS/main.scss" rel="stylesheet">
    </head>
    <body>
    <?php include_once 'navbar.php'; ?>

    <h2>Profile Page</h2>
        <div>
            <p>Your account details are below:</p>
            <table>
                <tr>
                    <td>Username:</td>
                    <td><?=$_SESSION['name']?></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><?=$password?></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><?=$email?></td>
                </tr>
            </table>
        </div>

        <?php include_once 'footer.php'; ?>
    </body>
</html>