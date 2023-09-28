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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Suppliers</title>
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
            <li><a href="stock.php">Stock</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="suppliers.php">Suppliers</a></li>
        </ul>
    </nav>
    <h1>Add new Supplier</h1>
    <form action="insertSuppliersForm.php">
        <label for="supplierName" name="supplierName">Supplier Name:*</label>
        <input type="text" name="supplierName" placeholder="Supplier">
        <br>
        <label for="supplierStreet" name="supplierStreet">Street*:</label>
        <input type="text" name="supplierStreet" placeholder="Street">
        <br>
        <label for="supplierPostcode" name="supplierPostcode">Postcode*:</label>
        <input type="text" name="supplierPostcode" placeholder="Postcode">
        <br>
        <label for="supplierCity" name="supplierCity">City*:</label>
        <input type="text" name="supplierCity" placeholder="City">
        <br>
        <label for="supplierCountry" name="supplierCountry">Country:</label>
        <input type="text" name="supplierCountry" placeholder="Country">
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <a href="suppliers.php">Cancel</a>
    </form>
    <footer>
        <h3>Inventory Manager</h3>
        <p>If problems ocurr contact the admin</p>
        <a href="mailto:email@example.com">Send Email</a>
    </footer>

</body>

</html>