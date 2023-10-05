<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['loggedin'])) {
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

$sql = " SELECT * FROM suppliers ";
$result = $con->query($sql);

if (!$result) {
    die("Invalid quary: " . $con->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="Assets/SCSS/main.scss">
</head>
<body>
    <nav aria-label="nav-top" class="nav-top">
        <a href="home.php">
            <h1>Website Title</h1>
        </a>
        <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <nav aria-label="nav-left" class="nav-left">
        <ul>
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="suppliers.php">Suppliers</a></li>
        </ul>
    </nav>
    <h1>Orders</h1>
    <a href="">New Order</a>
    <table>
        <tr>
            <th></th>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
    <footer>
        <h3>Inventory Manager</h3>
        <p>If problems ocurr contact the admin</p>
        <a href="mailto:email@example.com">Send Email</a>
    </footer>
</body>
</html>