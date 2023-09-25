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

$sql = " SELECT * FROM products ";
$result = $con->query($sql);
$con->close();
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
                <li><a href="products.php">Products</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="suppliers.php">Suppliers</a></li>
            </ul>
        </nav>
        <div class="search">
            <input type="text" placeholder="Search Products" name="search">
            <button type="submit" >Search</button>
        </div>
        <div class="product-list">
            <h1>Products</h1>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
                <?php while($rows = $result->fetch_assoc() )
                    {
                ?>
                <tr>
                    <td><?php echo $rows['id'];?></td>
                    <td><?php echo $rows['productName'];?></td>
                    <td><?php echo $rows['quantity'];?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <footer>
            <h3>Inventory Manager</h3>
            <p>If problems ocurr contact the admin</p>
            <a href="mailto:email@example.com">Send Email</a>
        </footer>
</html>