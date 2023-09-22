<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if ( !isset($_SESSION['loggedin']) ) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home Page</title>
        <meta name="discription" content="">
        <link href="SCSS/main.scss" rel="stylesheet">
    </head>
    <body>
        <nav aria-label="nav-top" class="nav-top">
            <a href="home.php"><h1>Website Title</h1></a>
            <ul>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <nav aria-label="nav-left" class="nav-left">
            <ul>
                <li><a href="home.php">Dashboard</a></li>
                <li><a href="product.php">Products</a></li>
                <li><a href="">Orders</a></li>
                <li><a href="">Customer</a></li>
                <li><a href="">Supplier</a></li>
                <li><a href="">Catergory</a></li>
                <li><a href="">Stock</a></li>
                <li><a href="">Sells</a></li>
            </ul>
        </nav>
        <div>
            <h1>Products</h1>
            <div class="product-list">
                
            </div>
        </div>
</html>
