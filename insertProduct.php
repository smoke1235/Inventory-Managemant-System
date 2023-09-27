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

$productName = $_REQUEST['productName'];
$quantity = $_REQUEST['quantity'];

$sql =  "INSERT INTO products (productName, quantity) VALUES ('$productName', '$quantity')";
if (mysqli_query($con, $sql)) {
    echo "insert succesfull";
} else {
    echo "insert unsuccesfull";
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="Assets/SCSS/main.scss">
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
                <li><a href="products.php">Products</a></li>
                <li><a href="stock.php">Stock</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="suppliers.php">Suppliers</a></li>
            </ul>
        </nav>
        <h1>Add New Product</h1>
        <form action="insertProduct.php" method="POST">
            <label for="productName" name="productName">Product Name *:</label>
            <input type="text" name="productName" id="productName" placeholder="Product Name" required>

            <label for="quantity" name="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" placeholder="0">

            <input type="submit" value="Submit">
        </form>
</body>
</html>